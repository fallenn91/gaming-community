<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ReconcileFollowerCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'followers:reconcile {--dry-run : Show differences without writing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate followers_count and following_count from the actual follows table';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Calculating real counters from follows table...');

        // Conteo real desde la BBDD
        $realFollowers = DB::table('follows')
          ->selectRaw('following_id as user_id, COUNT(*) as total')
          ->groupBy('following_id')
          ->pluck('total', 'following_id');

        $realFollowing = DB::table('follows')
          ->selectRaw('follower_id as user_id, COUNT(*) as total')
          ->groupBy('follower_id')
          ->pluck('total', 'follower_id');

        $users = DB::table('users')
          ->select('id', 'username', 'followers_count', 'following_count')
          ->get();

        $discrepancies = 0;

        foreach ($users as $user) {
          $realFC = $realFollowers[$user->id] ?? 0;
          $realFng = $realFollowing[$user->id] ?? 0;

          $fcMismatch = (int)$user->followers_count !== $realFC;
          $fngMismatch = (int)$user->following_count !== $realFng;

          if ($fcMismatch || $fngMismatch) {
            $discrepancies++;
            $this->line(sprintf(
              ' User %-20s | followers: stored=%d real=%d | following: stored=%d real=%d',
              $user->username,
              $user->followers_count, $realFC,
              $user->following_count, $realFng
            ));

            if (! $this->option('dry-run')) {
              DB::table('users')->where('id', $user->id)->update([
                'followers_count' => $realFC,
                'following_count' => $realFng,
              ]);
            }
          }
        }

        if ($discrepancies == 0) {
          $this->info('All counters synchronized.');
        } else {
          $action = $this->option('dry-run') ? 'Found (dry-run, no changes)' : 'corrected';
          $this->warn("{$discrepancies} discrepancies {$action}.");
        }

        return Command::SUCCESS;
    }

}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class cronjob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:dribble';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user account from Dribble';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $url = $user->dribbble; //get dribbble link from db
            if (!empty($url)) {
                $client = new Client;
                $crawler = $client->request('GET', $url);
                $scrape['items'] = $crawler->filter('.js-shot-thumbnail-base')->each(function ($node) {
                    $images =  $node->filter('figure > img')->attr('src');
                    $text = $node->filter('.shot-title')->text();
                    $link = "https://dribbble.com" . $node->filter('.shot-thumbnail-link')->attr('href');
                    return ["link" => $link, "image" => $images, "text" => $text];
                });
                $portfolioItems = array_slice($scrape['items'], 0, 4);
                if (isset($user->portfolio[0])) {
                    $itemsPortfolio[] = \App\Models\Portfolio::where('user_id', $user->id)
                        ->orderBy('id', 'asc')
                        ->get();

                    $counter = 0;
                    foreach ($itemsPortfolio[0] as $itemPortfolio) {
                        \App\Models\Portfolio::where('id', $itemPortfolio->id)
                            ->update([
                                'image' => $portfolioItems[$counter]['image'],
                                'link' => $portfolioItems[$counter]['link'],
                                'text' => $portfolioItems[$counter]['text']
                            ]);
                        $counter++;
                    }
                } else {
                    foreach ($portfolioItems as $portfolioitem) {
                        $portfolio = new \App\Models\Portfolio();
                        $portfolio->image = $portfolioitem['image'];
                        $portfolio->link = $portfolioitem['link'];
                        $portfolio->text = $portfolioitem['text'];
                        $portfolio->user_id = $user->id;
                        $portfolio->save();
                    }
                }
                echo 'Dribbble profile updated for ' . $user->first_name . " " . $user->lastname . "\n";
            } else {
                $scrape['items'] = "no items to update";
                echo 'No update needen for ' . $user->first_name . " " . $user->lastname . "\n";
            }
        }
    }
}

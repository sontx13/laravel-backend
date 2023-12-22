<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\TinTucUtils;

class DongBoTinTuc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tintuc:dongbo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dong bo tin tuc tu cong TTDT BG';

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
     * @return mixed
     */
    public function handle()
    {
        $results = \App\Models\ArticleSync::where("status", 0)->get();

        foreach ($results as $index => $result) {

            $latestArticleId = $result->article_id;
            $group_id = $result->group_id;
            $category_id = $result->category_id;

            $url = 'https://bacgiang.gov.vn/api/jsonws/portal-jsonws-portlet.jsonarticle/get-articles';

            $client = new \GuzzleHttp\Client();

            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Basic YXBwLnR0cGFAYmFjZ2lhbmcuZ292LnZuOkFwcHR0cGExMiE=',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Safari/537.36'
                ],
                'query' => [
                    'categoryId' => $category_id,
                    'groupId' => $group_id,
                    'articleId' => $latestArticleId
                ]
            ]);

            $articlesList = [];

            $articles = json_decode($response->getBody());

            $domObj = new \DOMDocument();

            foreach ($articles as &$article) {

                if (empty($article->body) || trim($article->body) == '') continue;

                $domObj->loadXML($article->body);
                $nodeList = $domObj->getElementsByTagName('static-content');
                $body = TinTucUtils::findAndReplaceImgAndHref($nodeList->item(0)->nodeValue);
                $summary = null;

                if (!empty($article->summary) && trim($article->summary) != '') {
                    $domObj->loadXML($article->summary);
                    $nodeList = $domObj->getElementsByTagName('Description');
                    $summary = TinTucUtils::findAndReplaceImgAndHref($nodeList->item(0)->nodeValue);
                }

                if (empty($article->title)) continue;
                $domObj->loadXML($article->title);
                $nodeList = $domObj->getElementsByTagName('Title');
                $title = TinTucUtils::findAndReplaceImgAndHref($nodeList->item(0)->nodeValue);

                $publishDate = Carbon::createFromTimestamp(round($article->publishDate / 1000));

                $createDate = Carbon::createFromTimestamp(round($article->createDate / 1000));

                $image = null;
                if (!empty($article->image)) {
                    $image = 'https://bacgiang.gov.vn' . $article->image;
                }

                $slug = $article->id;

                array_push($articlesList, [
                    'author_id' => 1,
                    'category_id' => $result->qcdc_cat_id,
                    'title' => $title,
                    'slug' => $slug,
                    'excerpt' => $summary,
                    'body' => $body,
                    'image' => $image,
                    'status' => 'PUBLISHED',
                    'created_at' => $createDate,
                    'published_at' => $publishDate,
                    'is_external' => 1,
                    'url_title' => $article->urlTitle
                ]);

                if ($article->id > $latestArticleId) {
                    $latestArticleId = $article->id;
                }
            }

            DB::table('posts')->insert($articlesList);

            \App\Models\ArticleSync::where('id', $result->id)->update(['article_id' => $latestArticleId]);
        }

        $this->info('Dong bo tin tuc tu cong TTDT thanh cong');
    }
}

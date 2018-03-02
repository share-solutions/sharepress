<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 11:10
 */

namespace prevenir\Http\Controllers\TemplateMatch\Frontpage;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\MenuItems;
use prevenir\Business\Models\Posts\People;
use prevenir\Business\Models\Posts\Post;
use prevenir\Business\Models\Posts\RolesTag;
use prevenir\Business\Repos\Posts\PostsRepo;
use prevenir\Http\Requests\Request;
use share\SharePress\Facades\Config;

class Index
{
    public function index(Request $request)
    {
        Config::load('acf');

		/**
		 *
		 * TODO:
		 * Lógica passa a:
		 * - ir buscar mais lidos
		 * - ir buscar destaques no máximo 3 excluindo os mais lidos
		 * - ir buscar os last excluindo os mais lidos e destaques
		 * - juntar destaques e last
		 * - cortar a junção em 3 e o resto
		 *
		 */

        /**
         * Destaques
         */
        $highlights = PostsRepo::getHomepageHighlights([]);
		$postsExcluding = count($highlights) > 0 ? array_pluck($highlights, 'ID') : [];

        /**
         * Artigos mais lidos
         */
		$mostRead = PostsRepo::getMostRead($postsExcluding);
		$postsExcluding = array_merge($postsExcluding, count($mostRead) > 0 ? array_pluck($mostRead, 'ID') : []);

        /**
         * Last Posts
         */
        $lastPosts = PostsRepo::getLastPosts(4, 0, $postsExcluding);

        /**
         * Especialistas respondem
         */
		$especialistasArticles = PostsRepo::getCategoryPosts(new Category(get_category(Config::get('acf.especialistas_respondem_category'))), 3);

        /**
         * Experimente Articles
         */
        $experimenteTaxTerm = Config::get('acf.experimente_tag');
        $experimenteCategories = Config::get('acf.categorias_experimente');
        $experimenteArticles = [];
        if (!!$experimenteCategories && !!$experimenteTaxTerm) {
            $experimenteCategories = array_pluck($experimenteCategories, 'categoria_destaque_experimente');
            $experimenteArticles = PostsRepo::getCategoriesPostsInTags ($experimenteCategories, [$experimenteTaxTerm], 1, -1);
        }

        /**
         * Conselho Científico People
         */
        $conselhoCientifico = [];
        $scientificCouncilTerm = new RolesTag(get_term(Config::get('acf.scientific_council_tag'), 'roles'));
        if (!$scientificCouncilTerm instanceof \WP_Error) {
            $conselhoCientifico = People::set('tax_query', [
                [
                    'taxonomy' => 'roles',
                    'field' => 'id',
                    'terms' => [$scientificCouncilTerm->term_id],
                    'operator' => 'IN'
                ]
            ])
                ->set('posts_per_page', 6)
                ->load();
        }

        return view('pages.homepage', [
            'highlights' => $highlights,
            'mostRead' => $mostRead,
            'lastPosts' => $lastPosts,
            'experimenteArticles' => $experimenteArticles,
            'especialistasArticles' => $especialistasArticles,
            'conselhoCientifico' => $conselhoCientifico,
            'scientificCouncilTerm' => $scientificCouncilTerm,
			'headerMenuItems' => $request->headerMenuItems,
			'footerMenuItems' => $request->footerMenuItems,
			'footerDisclaimer' => $request->footerDisclaimer,
        ]);
    }
}
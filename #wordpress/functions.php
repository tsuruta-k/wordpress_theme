<?php
/**
 * This file loads theme Functions and definitions.
 * @link		http://worldagent.jp/
 * @author		World agent
 * @copyright	Copyright (c) World agent
 */

/******************************************************
*
* デバッグ用
*
*******************************************************/
function pr($data){
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}


/******************************************************
*
* 特殊記号 画像変換を停止
*
*******************************************************/
function disable_emoji() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emoji' );


/******************************************************
*
* 管理バーを非表示にする
*
*******************************************************/
function my_function_admin_bar(){
return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');


/******************************************************
*
* コメントフォーム、検索フォーム等をHTML5のマークアップに
*
*******************************************************/
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );


/******************************************************
*
* titlw タグの出力 と タイトルの区切り線を変更
*
*******************************************************/
add_theme_support( 'title-tag' );
function custom_title_separator($sep) {
	$sep = ' | ';
	return $sep;
}
add_filter( 'document_title_separator', 'custom_title_separator' );


/******************************************************
*
* 固定ページの画像パスを相対パスへ
*
*******************************************************/
function replaceImagePath($arg) {
$content = str_replace('"img/', '"' . get_bloginfo('template_directory') . '/img/', $arg);
return $content;
}
add_action('the_content', 'replaceImagePath');


/******************************************************
*
* 固定ページのみ自動整形機能を無効化します。
*
*******************************************************/
function disable_page_wpautop() {
	if ( is_page() ) remove_filter( 'the_content', 'wpautop' );
}
add_action( 'wp', 'disable_page_wpautop' );


/******************************************************
*
* 投稿キャプチャー画像を追加。
*
*******************************************************/
add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 150, true);


/******************************************************
*
* 本文からの抜粋末尾の文字列を指定する
*
*******************************************************/
function custom_excerpt_more($more) {
	return '…';
}
add_filter('excerpt_more', 'custom_excerpt_more');


/******************************************************
*
* 文字を丸める
*
*******************************************************/
function mb_strimlen($str, $start, $length, $trimmarker = '', $encoding = false) {
	$encoding = $encoding ? $encoding : mb_internal_encoding();
	$str = mb_substr($str, $start, mb_strlen($str), $encoding);
	if (mb_strlen($str, $encoding) > $length) {
		$markerlen = mb_strlen($trimmarker, $encoding);
		$str = mb_substr($str, 0, $length - $markerlen, $encoding) . $trimmarker;
	}
	return $str;
}


/******************************************************
*
* テキストエディタにフォントサイズ変更ボタン追加
*
*******************************************************/
function editor_add_buttons($array) {
 array_push($array, 'fontsizeselect');
 return $array;
}
add_filter('mce_buttons', 'editor_add_buttons');


/******************************************************
*
* フォントサイズ変更ボタンを％指定に変更
*
*******************************************************/
function customize_tinymce_settings($array) {
 $array['fontsize_formats'] = '50% 75% 100% 150% 200%';
 return $array;
}
add_filter( 'tiny_mce_before_init', 'customize_tinymce_settings' );


/******************************************************
*
* ファイル へのディレクトリ
*
*******************************************************/
function img_dir(){
	return get_template_directory_uri().'/img/';
}
function e_img_dir(){
	echo get_template_directory_uri().'/img/';
}
function theme_dir(){
	return get_template_directory().'/';
}
function e_theme_dir(){
	echo get_template_directory().'/';
}


/******************************************************
*
* HOME リンク
*
*******************************************************/
function home(){
	return esc_url(home_url('/'));
}
function e_home(){
	echo esc_url(home_url('/'));
}



/******************************************************
*
* CSS + JS の読み込み
*
*******************************************************/
function add_frontend_files() {
	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'drawer', 'https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.1/css/drawer.min.css', array(), '', 'all' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '', 'all' );
	wp_enqueue_style( 'pageslide', get_template_directory_uri() . '/css/pageslide.css', array(), '', 'all' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '', 'all' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css', array(), '', 'all' );
	wp_enqueue_style( 'basic', get_template_directory_uri() . '/css/basic.css', array('bootstrap'), '', 'all' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '', 'all' );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array('style'), '', 'all' );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'scroll', 'https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll-lite.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'drawer', 'https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.1/js/drawer.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'pageslide', get_template_directory_uri() . '/js/jquery.pageslide.js', array('jquery'), '', true );
	wp_enqueue_script( 'matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js', array('jquery'), '', true );
	wp_enqueue_script( 'func', get_template_directory_uri() . '/js/func.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'add_frontend_files' );


/******************************************************
*
* 投稿画面のカテゴリの順番を変えない
*
*******************************************************/
function my_wp_terms_checklist_args( $args, $post_id ){
	 if ( $args['checked_ontop'] !== false ){
		$args['checked_ontop'] = false;
	 }
	 return $args;
}
add_filter('wp_terms_checklist_args', 'my_wp_terms_checklist_args',10,2);


/******************************************************
*
*  固定ページ作成自動化
*
*******************************************************/
// $page_slug = array(
// 	'ゆめこんとは'            => 'about',
// 	'会社概要'           => 'company',
// 	'お問い合わせ・ご予約'         => 'contact',
// 	'料金&よくある質問'            => 'faq',
// 	'ご利用の流れ'   => 'flow',
// 	'ご利用規約'      => 'kiyaku',
// 	'婚活の心得'         => 'knowledge',
// 	'プライバシーポリシー'        => 'policy',
// 	'お客様の声'      => 'voice',
// );
// function exist_page($type, $slug){
// 	$query = new WP_Query();
// 	$query->query("post_type={$type}&name={$slug}");
// 	if($query->have_posts()) {
// 		return true;
// 	} else {
// 		return false;
// 	}
// }
// foreach ($page_slug as $title => $slug) {
// 	if (exist_page('page', $slug) == false) {
// 		$args = array(
// 			'post_type'   => 'page',
// 			'post_title'  => $title,
// 			'post_name'   => $slug,
// 			'post_status' => 'publish'
// 		);
// 		wp_insert_post( $args );
// 	}
// }


/******************************************************
*
* カスタム投稿追加
*
*******************************************************/
// add_action('init', 'add_post_type');
// function add_post_type() {
// 	register_post_type( 'post_results',
// 		array(
// 			'labels' => array(
// 			'name' => __( '運営ノウハウ' ),
// 			'singular_name' => __( '運営ノウハウ' )
// 		),
// 		'public'        => true,
// 		'has_archive'   => true,
// 		'menu_position' => 5,
// 		'supports'      => array( 'title', 'editor', 'thumbnail' ),
// 		'taxonomies'            => array( 'post_tag' ),
// 		)
// 	);
// 	register_taxonomy(
// 		'cat_results',
// 		'post_results',
// 		array(
// 			'hierarchical'          => true,
// 			'label'                 => '運営ノウハウカテゴリ',
// 			'singular_label'        => '運営ノウハウカテゴリ',
// 			'public'                => true,
// 			'show_ui'               => true,
// 			'query_var'             => true,
// 		)
// 	);
// }


/******************************************************
*
* カスタムフィールド
*
*******************************************************/

$media_meta = array(
	'media' => array(
		array(
			'name' => '大キャッチ',
			'desc' => '',
			'id'   => 'media_title_lg',
			'type' => 'text',
		),
		array(
			'name' => '中キャッチ',
			'desc' => '',
			'id'   => 'media_title_md',
			'type' => 'text',
		),
		array(
			'name' => 'テキスト',
			'desc' => '',
			'id'   => 'media_text',
			'type' => 'wysiwyg',
			'options' => array(),
		),
	),
);

if ( file_exists(  get_template_directory() . '/vendors/cmb2/init.php' ) ) {
	require_once  get_template_directory() . '/vendors/cmb2/init.php';
}

add_action( 'cmb2_admin_init', 'add_custom_meta_box' );

function add_custom_meta_box() {

	global $media_meta;

	$media_group = new_cmb2_box( array(
		'id'            => 'media_metabox',
		'title'         => 'メディアテキストボックス',
		'object_types'  => array( 'post', 'post_knowhow', 'post_knowhow', 'post_management', 'post_tools', 'post_legal', 'post_network', 'post_permit' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$media_group_id = $media_group->add_field( array(
		'id'          => 'media_metabox_group',
		'type'        => 'group',
		'description' => '',
		'options'     => array(
			'group_title'   => 'メディアテキストフィールド',
			'add_button'    => 'メディアテキストフィールドを追加する',
			'remove_button' => 'メディアテキストフィールドを削除する',
			'sortable'      => true,
		),
	) );

	foreach ($media_meta['media'] as $key => $value) {
		$media_group->add_group_field( $media_group_id, $value );
	}

}

/******************************************************
*
* ページネーション
*
*******************************************************/
function pagination($pages = '', $range = 2) {
	$showitems = ($range * 2)+1;

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}

	if(1 != $pages)
	{
		echo "<div class='pagination'>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
			}
		}

		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</div>\n";
	}
}
<?php //echo json_encode


	$categories = get_the_category(); 
	// var_dump($categories);
	$outputCategories = "";
	$outputCategoryLinks = "";
	$outputCategoryNames = "";
	if($categories){
		foreach ($categories as $category) {
			$outputCategories .= '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name ."</a>". ",";
			$outputCategoryLinks .= get_category_link($category->term_id) . ",";
			$outputCategoryNames .= $category->cat_name;
		}
	}
	$outputCategories = trim($outputCategories, ",");
	
	//$escapePercentSign = "%";
	//__("No comments", "palette"), __("1 comments", "palette"), sprintf(__("%s comments", "palette"), $escapePercentSign)
	//get_comments_number


	echo json_encode(array(
	'post_link' => get_the_permalink(),
	'post_ID' => $post->ID,
	'post_type' => $post->post_type,
	//'post_name' => $post->post_name,
	'post_title' => $post->post_title,
	'post_author' => $post->post_author,
	'post_date' => $post->post_date,
	'post_category_names' => $outputCategoryNames,
	'post_category_links' => $outputCategoryLinks,

	//get_the_time('M') get_the_time('j') 
	//formatted
	'post_formatted_date' => sprintf("%s %s%s,%s",__("Posted on","palette"),get_the_time('M'),get_the_time('d'),get_the_time('Y')),
	'post_formatted_time_ago' => timeAgo(time(),get_the_time("U")),
	'post_formatted_category' =>sprintf("%s %s",__("in Category","palette"),$outputCategories),
	'post_formatted_comment_count' => get_comments_number(),

	'post_content' => $post->post_content,
	'post_excerpt' => $post->post_excerpt,
	'post_modified' => $post->post_modified,

	'has_post_thumbnail' => has_post_thumbnail(),
	'the_post_thumbnail' => get_the_post_thumbnail(),



	// comments
	'comment_status' => $post->comment_status,
	'comment_count' => $post->comment_count,
	//'comments_template' => comments_template()

)); ?>
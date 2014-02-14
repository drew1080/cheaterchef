<?php
set_time_limit(0);

// COPY THE DUMMY FOLDER ======================================================================


// anchor_search widgets

global $upload_folder_path,$wpdb,$blog_id;
$year_date = date('Y');
$upload_folder_path = wp_upload_dir();
$upload_folder_path = $upload_folder_path['basedir']."/dummy";
if($blog_id){ $thumb_url = "&amp;bid=$blog_id";}
$folderpath = $upload_folder_path . "dummy/";
$strpost = strpos(get_stylesheet_directory(),'wp-content');
$dirinfo = wp_upload_dir();
$target =$dirinfo['basedir']."/dummy";
full_copy( get_stylesheet_directory()."/images/dummy/", $target );
function full_copy( $source, $target ) 
{
	global $upload_folder_path;
	$imagepatharr = explode('/',$upload_folder_path."dummy");
	$year_path = ABSPATH;
	for($i=0;$i<count($imagepatharr);$i++)
	{
	  if($imagepatharr[$i])
	  {
		  $year_path .= $imagepatharr[$i]."/";
		  //echo "<br />";
		  if (!file_exists($year_path)){
			  @mkdir($year_path, 0777);
		  }     
		}
	}
	@mkdir( $target );
		$d = dir( $source );
		
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
		}
	
		$d->close();
	}else {
		copy( $source, $target );
	}
}
require_once(ABSPATH.'wp-admin/includes/taxonomy.php');
$dummy_image_path = get_stylesheet_directory_uri().'/images/dummy/';

/*	Updating General options START	*/

$a = get_option('supreme_theme_settings');
$b = array(
		'supreme_logo_url' 					=> get_stylesheet_directory_uri()."/images/logo.png",
		'supreme_archive_display_excerpt' 	=> $a['supreme_archive_display_excerpt'],
		'supreme_frontpage_display_excerpt' => $a['supreme_frontpage_display_excerpt'],
		'supreme_search_display_excerpt' 	=> $a['supreme_search_display_excerpt'],
		'supreme_header_primary_search' 	=> $a['supreme_header_primary_search'],
		'supreme_header_secondary_search' 	=> $a['supreme_header_secondary_search'],
		'footer_insert' 					=> '<p class="copyright">Copyright &copy; [the-year] [site-link].</p><p class="credit">Powered by [wp-link], [theme-link], and [child-link].</p><p class="temp-logo"> Designed by <a class="templatic_logo" href="http://templatic.com/" alt="wordpress themes" title="wordpress themes"><img src="'.get_template_directory_uri().'/images/templatic-wordpress-themes.png" alt="wordpress themes"/></a></p>',
		'supreme_global_layout' 			=> $a['supreme_global_layout'],
		'anchor_fb_share'					=> 1,
		'anchor_tweet_share'				=> 1,
		'anchor_send_to_frnd'				=> 1,
		'supreme_show_breadcrumb'			=> 1,
);

update_option("blogdescription","ALL PURPOSE WORDPRESS THEME");
update_option('supreme_theme_settings',$b);
/*	Updating General options END	*/

/* =================================== BLOG SETTING STARTS ====================================== */
//Adding a "Blog" category.
$category_array[] = array('cat_name' => 'Blog', 'category_description' => 'You can write small description here to explain which type of posts are there in this category.');
$category_array[] = array('cat_name' => 'Events');
$category_array[] = array('cat_name' => 'Festivals');
insert_category($category_array);
function insert_category($category_array)
{
	foreach($category_array as $val)
	{
		wp_insert_category( $val);
	}
}
/////////////// TERMS END ///////////////

/*Function to insert taxonomy category EOF*/

//Adding some Blogs.
$dummy_image_path = get_template_directory_uri().'/images/dummy/';

$post_array = array();
$blog_image = array();
$post_meta = array();
$tags_input = array();
$tags_input = array('Musical');
$post_author = $wpdb->get_var("SELECT ID FROM $wpdb->users order by ID asc limit 1");
$post_info = array();
$blog_image[] = "dummy/img1.png";
$post_info[] = array(
					"post_title"	=>	'An Exhibition',
					"post_type"	=> 'post',
					"post_content"	=>	"<p>An exhibition, in the most general sense, is an organized presentation and display of a selection of items. In practice, exhibitions usually occur within museums, galleries and exhibition halls, and World's Fairs. Exhibitions include [whatever as in major art museums and small art galleries; interpretive exhibitions, as at natural history museums and history museums], for example; and commercial exhibitions, or trade fairs.</p> <p>The word &quot;exhibition&quot; is usually, but not always, the word used for a collection of items. Sometimes &quot;exhibit&quot; is synonymous with &quot;exhibition&quot;, but &quot;exhibit&quot; generally refers to a single item being exhibited within an exhibition. Exhibitions may be permanent displays or temporary, but in common usage, &quot;exhibitions&quot; are considered temporary and usually scheduled to open and close on specific dates. While many exhibitions are shown in just one venue, some exhibitions are shown in multiple locations and are called travelling exhibitions, and some are online exhibitions.</p> <p>Though exhibitions are common events, the concept of an exhibition is quite wide and encompasses many variables. Exhibitions range from an extraordinarily large event such as a World's Fair exposition to small one-artist solo shows or a display of just one item. Curators are sometimes involved as the people who select the items in an exhibition. Writers and editors are sometimes needed to write text, labels and accompanying printed material such as catalogs and books. Architects, exhibition designers, graphic designers and other designers may be needed to shape the exhibition space and give form to the editorial content. Exhibition also means a scholarship.</p>",
					"post_excerpt" => "<p>An exhibition, in the most general sense, is an organized presentation and display of a selection of items. In practice, exhibitions usually occur within museums, galleries and exhibition halls, and World's Fairs. Exhibitions include [whatever as in major art museums and small art galleries; interpretive exhibitions, as at natural history museums and history museums], for example; and commercial exhibitions, or trade fairs...</p>",
					"post_category"	=>	array('Events'),
					"post_meta"		=>	$post_meta,
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image
					);

$blog_image = array();
$tags_input = array();
$tags_input = array('Awesome');
$blog_image[] = "dummy/img2.png";
$post_info[] = array(
					"post_title"	=>	'Festivals',
					"post_type"	=> 'post',
					"post_content"	=>	'<p>A festival or gala is an event, usually and ordinarily staged by a local community, which centers on and celebrates some unique aspect of that community and the Festival. Among many religions, a feast is a set of celebrations in honour of God or gods. A feast and a festival are historically interchangeable. However, the term &quot;feast&quot; has also entered common secular parlance as a synonym for any large or elaborate meal. When used as in the meaning of a festival, most often refers to a religious festival rather than a film or art festival. In the Christian liturgical calendar there are two principal feasts, properly known as the Feast of the Nativity of our Lord (Christmas) and the Feast of the Resurrection, (Easter). In the Catholic, Eastern Orthodox, and Anglican liturgical calendars there are a great number of lesser feasts throughout the year commemorating saints, sacred events, doctrines, etc.</p>',
					"post_excerpt" => "<p>A festival or gala is an event, usually and ordinarily staged by a local community, which centers on and celebrates some unique aspect of that community and the Festival. Among many religions, a feast is a set of celebrations in honour of God or gods. A feast and a festival are historically interchangeable. However, the term &quot;feast&quot; has also entered common secular parlance as a synonym for any large or elaborate meal...</p>",
					"post_category"	=>	array('Blog'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image
					);
$blog_image = array();
$post_meta = array();
$tags_input = array();
$tags_input = array('Life');
$blog_image[] = "dummy/img3.png";
$post_info[] = array(
					"post_title"	=>	'Nightlife',
					"post_type"	=> 'post',
					"post_content"	=>	'Nightlife is the collective term for any entertainment that is available and more popular from the late evening into the early hours of the morning. It includes the public houses, nightclubs, discothèques, bars, live music, concert, cabaret, small theatres, small cinemas, shows, and sometimes restaurants a specific area may have; these venues often require cover charge for admission, and make their money on alcoholic beverages. Nightlife encompasses entertainment from the fairly tame to the risque to the seedy. Nightlife entertainment is inherently edgier than daytime amusements, and usually more oriented to adults, including "adult entertainment" in red-light districts. People who prefer to be active during the night-time are called night owls.',
					"post_excerpt" => "Nightlife is the collective term for any entertainment that is available and more popular from the late evening into the early hours of the morning. It includes the public houses, nightclubs, discothèques, bars, live music, concert, cabaret, small theatres, small cinemas, shows, and sometimes restaurants...",
					"post_category"	=>	array('Events'),
					"post_meta"		=>	$post_meta,
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image
					);
$blog_image = array();
$post_meta = array();
$tags_input = array();
$tags_input = array('Life');
$blog_image[] = "dummy/img4.png";
$post_info[] = array(
					"post_title"	=>	'Life Beyond Earth',
					"post_type"	=> 'post',
					"post_content"	=>	'<p>Extraterrestrial life is defined as life that does not originate from Earth. Referred to as alien life, or simply aliens (or space aliens, to differentiate from other definitions of alien or aliens) these hypothetical forms of life range from simple bacteria-like organisms to beings far more complex than humans. The development and testing of hypotheses on extraterrestrial life is known as exobiology or astrobiology; the term astrobiology, however, includes the study of life on Earth viewed in its astronomical context. Many scientists consider extraterrestrial life to be plausible, but there is no conclusive evidence of the existence of extraterrestrial life.</p>',
					"post_excerpt" => "<p>Extraterrestrial life is defined as life that does not originate from Earth. Referred to as alien life, or simply aliens (or space aliens, to differentiate from other definitions of alien or aliens) these hypothetical forms of life range from simple bacteria-like organisms to beings far more complex than humans...</p>",
					"post_category"	=>	array('Events'),
					"post_meta"		=>	$post_meta,
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image
					);
$blog_image = array();
$tags_input = array();
$tags_input = array('Awesome');
$blog_image[] = "dummy/img5.png";
$post_info[] = array(
					"post_title"	=>	'Social Innovation',
					"post_type"	=> 'post',
					"post_content"	=>	'<p>Social innovation refers to new strategies, concepts, ideas and organizations that meet social needs of all kinds - from working conditions and education to community development and health - and that extend and strengthen civil society. The term has overlapping meanings. It can be used to refer to social processes of innovation, such as open source methods and techniques. Alternatively it refers to innovations which have a social purpose - like microcredit or distance learning. The concept can also be related to social entrepreneurship (entrepreneurship is not necessarily innovative, but it can be a means of innovation) and it also overlaps with innovation in public policy and governance. Social innovation can take place within government, the for-profit sector, the nonprofit sector (also known as the third sector), or in the spaces between them. Research has focused on the types of platforms needed to facilitate such cross-sector collaborative social innovation. Social innovation is gaining visibility within academia. Prominent innovators associated with the term include Bangladeshi Muhammad Yunus, the founder of Grameen Bank which pioneered the concept of microcredit for supporting innovators in multiple developing countries in Asia, Africa and Latin America and Stephen Goldsmith, former Indianapolis mayor who engaged the private sector in providing many city services.</p>',
					"post_excerpt" => "<p>Social innovation refers to new strategies, concepts, ideas and organizations that meet social needs of all kinds - from working conditions and education to community development and health - and that extend and strengthen civil society. The term has overlapping meanings. It can be used to refer to social processes of innovation, such as open source methods and techniques...</p>",
					"post_category"	=>	array('Festivals'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image
					);
					
					
$blog_image = array();
$tags_input = array();
$tags_input = array('Sample');
$blog_image[] = "dummy/img1.png";
$post_info[] = array(
					"post_title"	=>	'Sample Lorem Ipsum Post',
					"post_type"	=> 'post',
					"post_content"	=>	'What is Lorem Ipsum?<br /><br />
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br /><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
<br /><br />Where does it come from?',
					"post_excerpt" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...",
					"post_category"	=>	array('Blog'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);
$blog_image = array();
$tags_input = array();
$tags_input = array('Festival');
$blog_image[] = "dummy/img2.png";
$post_info[] = array(
					"post_title"	=>	'Sample Blog Post',
					"post_type"	=> 'post',
					"post_content"	=>	'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					"post_excerpt" => "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...",
					"post_category"	=>	array('Blog'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);
$blog_image = array();
$tags_input = array();
$tags_input = array('Festival');
$blog_image[] = "dummy/img3.png";
$post_info[] = array(
					"post_title"	=>	'What is Lorem Ipsum?',
					"post_type"	=> 'post',
					"post_content"	=>	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br /><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
<br /><br />Where does it come from?',
					"post_excerpt" => "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum...",
					"post_category"	=>	array('Blog'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);
$blog_image = array();
$post_meta = array();
$blog_image[] = "dummy/img4.png";
$tags_input = array();
$tags_input = array('Festival');
$post_info[] = array(
					"post_title"	=>	'Letraset sheets',
					"post_type"	=> 'post',
					"post_content"	=>	'When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br /><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br /><br />Where does it come from?',
					"post_excerpt" => "When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum...",	
					"post_category"	=>	array('Events'),
					"post_meta"		=>	$post_meta,
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);
$blog_image = array();
$blog_image[] = "dummy/img5.png";
$post_info[] = array(
					"post_title"	=>	'Why do we use it?',
					"post_type"	=> 'post',
					"post_content"	=>	' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br /><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
					"post_excerpt" => "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum...",
					"post_category"	=>	array('Blog'),
					"post_image"	=>	$blog_image,
					);

$blog_image = array();
$tags_input = array();
$tags_input = array('Festival');
$blog_image[] = "dummy/img5.png";
$post_info[] = array(
					"post_title"	=>	'History Of Church',
					"post_type"	=> 'post',
					"post_content"	=>	"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat",
					"post_excerpt" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat",
					"post_category"	=>	array('Blog','Festivals','Events'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);

$blog_image = array();
$tags_input = array();
$tags_input = array('Sample');
$blog_image[] = "dummy/img1.png";
$post_info[] = array(
					"post_title"	=>	"Celebrating Founder's Day",
					"post_type"	=> 'post',
					"post_content"	=>	"Founder's Day is commemorated every year on September 13, the day Claude Martin died. Some of the traditions of this day include an extended formal assembly in the morning with a faculty march, a speech by a prominent guest or alumnus, the playing of bagpipes, singing of the school song and other selected hymns by the College choir, and the laying of a wreath at Claude Martin's tomb. For the Founder's Day dinner the entire senior school and staff are treated to an elaborate sit-down dinner in the afternoon. Claude Martin had apparently listed in his will that his death should not be commemorated as a day of mourning but one of celebration of his life. He had also written out a menu for the meal to be served. Although today, the menu does not remain the same, the tradition of the Founder's Day dinner is still preserved. A Founder's Day Social is held in the evening for the senior school. Classes are suspended on Founder's Day, which is generally followed by a school holiday.",
					"post_excerpt" => "Founder's Day is commemorated every year on September 13, the day Claude Martin died. Some of the traditions of this day include an extended formal assembly in the morning with a faculty march, a speech by a prominent guest or alumnus, the playing of bagpipes, singing of the school song and other selected hymns by the College choir, and the laying of a wreath at Claude Martin's tomb...",
					"post_category"	=>	array('Festivals'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);
$blog_image = array();
$tags_input = array();
$tags_input = array('Festival');
$blog_image[] = "dummy/img2.png";
$post_info[] = array(
					"post_title"	=>	'Convocation 2012',
					"post_type"	=> 'post',
					"post_content"	=>	"In some universities, the term 'convocation' refers specifically to the entirety of the alumni of a college which function as one of the university's representative bodies. Due to its inordinate size, the Convocation will elect a standing committee, which is responsible for making representations concerning the views of the alumni to the university administration. The convocation also, however, can hold general meetings, at which any alumnus can attend. The main function of the convocation is to represent the views of the alumni to the university administration, to encourage co-operation among alumni (esp. in regard to donations), and to elect members of the University's governing body (known variously as the Senate, Council, Board, etc., depending on the particular institution, but basically equivalent to a board of directors of a corporation.). In the University of Oxford, Convocation was originally the main governing body of the University, consisting of all doctors and masters of the University, but it now comprises all graduates of the university and its only remaining function is to elect the Chancellor of the University and the Professor of Poetry.",
					"post_excerpt" => "In some universities, the term 'convocation' refers specifically to the entirety of the alumni of a college which function as one of the university's representative bodies. Due to its inordinate size, the Convocation will elect a standing committee, which is responsible for making representations concerning the views of the alumni to the university administration...",
					"post_category"	=>	array('Blog'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);


$blog_image = array();
$post_meta = array();
$tags_input = array();
$tags_input = array('Awesome');
$blog_image[] = "dummy/img4.png";
$post_info[] = array(
					"post_title"	=>	'Art of the American Soldier',
					"post_type"	=> 'post',
					"post_content"	=>	"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat",
					"post_excerpt" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat",
					"post_category"	=>	array('Events'),
					"post_meta"		=>	$post_meta,
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);

$blog_image = array();
$tags_input = array();
$tags_input = array('Festival');
$blog_image[] = "dummy/img1.png";
$post_info[] = array(
					"post_title"	=>	'A Weekend in Historic Philadelphia',
					"post_type"	=> 'post',
					"post_content"	=>	"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat",
					"post_excerpt" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat",
					"post_category"	=>	array('Festivals'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);

$blog_image = array();
$tags_input = array();
$tags_input = array('Festival');
$blog_image[] = "dummy/Templatic-Theme-Gallery.png";
$post_info[] = array(
					"post_title"	=>	'Wordpress Themes Club',
					"post_type"	=> 'post',
					"post_content"	=>	'The Templatic <a href="http://templatic.com/premium-themes-club/">Wordpress Themes Club</a> membership is ideal for any WordPress developer and freelancer that needs access to a wide variety of Wordpress themes. This themes collection saves you hundreds of dollars and also gives you the fantastic deal of allowing you to install any of our themes on unlimited domains.

You can see below just a few of our WordPress themes that are included in the club membership

&nbsp;
<img src="http://templatic.com/_data/images/Business-Directory-Theme-For-Wordpress_GeoPlaces.png" class="alignleft" /><strong>GeoPlaces</strong> - <a href="http://templatic.com/app-themes/geo-places-city-directory-wordpress-theme">Business Directory Theme</a>
The popular business directory theme that lets you have your very own local business listings directory or an international companies pages directory. This elegant and responsive design theme gives you powerful admin features to run a free or paid local business directory or both. GeoPlaces even has its own integrated events section so you not only get a business directory but an events directory too.


<img src="http://templatic.com/_data/images/Car-Classifieds-Wordpress-Theme_Automotive.png" class="alignleft"/><strong>Automotive</strong> - <a href="http://templatic.com/cms-themes/automotive-responsive-vehicle-directory">Car Classifieds Theme</a>
A responsive auto classifieds theme that gives you the ability of allowing vehicles submission on free or paid listing packages which you decide on the price and duration. This sleek auto classifieds and car directory theme is also WooCommerce compatible so you can even use part of your site to run as a car spares online store. Details


<img src="http://templatic.com/_data/images/Daily-Deal-Wordpress-Deals-Theme_DailyDeal.png" class="alignleft"/><strong>Daily Deal</strong> - <a href="http://templatic.com/app-themes/daily-deal-premium-wordpress-app-theme">Deals Theme</a>
A powerful Deals theme for WordPress which lets your visitors buy or sell deals on your deals website. Daily Deal is by far the easiest and cheapest way to create a deals site where you can earn money by creating different deals submission price packages but you can also allow free deal submissions. Details


<img src="http://templatic.com/_data/images/Events-Directory-Wordpress-Theme_Events.png" class="alignleft"/><strong>Events V2</strong> - <a href="http://templatic.com/app-themes/events">Events Directory Theme</a>
Launch a successful Events directory portal with this elegant responsive events theme. The theme has many powerful admin features including allowing event organizers to submit events on free or paid payment packages. This theme is simple to setup and you can get your events site up in no time.


<img src="http://templatic.com/_data/images/Events-Manager-Wordpress-Theme_NightLife.png" class="alignleft"/><strong>NightLife</strong> - <a href="http://templatic.com/cms-themes/nightlife-events-directory-wordpress-theme">Events Directory Theme</a>
A beautifully designed events management theme which is responsive and allows you to run an events website. Allow event organizers free or paid event listing submissions and offer online event registrations. Nightlife is feature-packed with all the features you can expect from an events directory theme.


<img src="http://templatic.com/_data/images/Hotel-Bookings-WordPress-Theme_5Star.png" class="alignleft"/><strong>5 Star</strong> - <a href="http://templatic.com/app-themes/5-star-responsive-hotel-theme">Online Hotel Booking and Reservations Theme</a>
A well designed hotel booking theme which is ideal for showcasing and promoting a hotel online in style. This responsive design hotel reservation Wordpress theme will surely impress your guests and is also a theme that gives you a lot of powerful features including an advanced online booking system and a booking calendar.


<img src="http://templatic.com/_data/images/Job-Classifieds-Wordpress-Theme_JobBoard.png" class="alignleft"/><strong>Job Board</strong> - <a href="http://templatic.com/app-themes/job-board">Job Classifieds Theme</a>
Start your job classifieds or job board site with this responsive premium jobs board theme. Allow employers to submit job listings for free, paid or both and also allow job seekers to apply for jobs or submit their resumes. Packed with great features you would expect from a premium jobs board theme. Details


<img src="http://templatic.com/_data/images/News-Magazine-Blog-WordPress-Theme_TechNews.png" class="alignleft"/><strong>TechNews</strong> - <a href="http://templatic.com/magazine-themes/technews-advanced-blog-theme">Blogging and News Theme</a>
A news theme that is an ideal solution for your a news blog. An elegant theme which is ideal for news blogs, magazine or newspaper sites. This mobile friendly theme is both responsive and WooCommerce compatible. Impress your visitors with the stylish layout and available color schemes. Details


<img src="http://templatic.com/_data/images/Property-Classifieds-Listings-WordPress-Theme_RealEstate.png" class="alignleft"/><strong>Real Estate V2</strong> - <a href="http://templatic.com/app-themes/real-estate-wordpress-theme-templatic">Property Classifieds Listings Theme</a>
This powerful IDX/MLS compatible real estate classifieds theme is both unique and powerful in the features it provides. With this real estate listings theme for WordPress, you can allow estate agencies and home sellers an opportunity to submit properties to your site. This real estate theme comes with many features including powerful search filter.


<img src="http://templatic.com/_data/images/Online-Store-Wordpress-Theme_ECommerce.png" class="alignleft"/><strong>e-Commerece</strong> - <a href="http://templatic.com/ecommerce-themes/e-commerce">Online Store Theme</a>
A powerful and elegant WooCoomerce compatible e-commerce WordPress theme with many features advanced features. This online store theme offers various modes of product display such as a shopping Cart, digital Shop or catalog mode. This theme for e-commerce offers multiple payment gateways, coupon codes. Details



See the full collection of the <a href="http://templatic.com/premium-themes-club/">WordPress Themes Club Membership</a>',
					"post_category"	=>	array('Festivals'),
					"tags_input"		=>	$tags_input,
					"post_image"	=>	$blog_image,
					);
					
/***- Insert Blog post BOF-***/
insert_posts($post_info);
require_once(ABSPATH . 'wp-admin/includes/image.php');
function insert_posts($post_info)
{
	global $wpdb,$current_user;
	for($i=0;$i<count($post_info);$i++)
	{
		$post_title = $post_info[$i]['post_title'];
		$post_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='post' and post_status in ('publish','draft')");
		if(!$post_count)
		{
			$post_info_arr = array();
			$catids_arr = array();
			$my_post = array();
			$post_info_arr = $post_info[$i];
			if($post_info_arr['post_category'])
			{
				for($c=0;$c<count($post_info_arr['post_category']);$c++)
				{
					$catids_arr[] = get_cat_ID($post_info_arr['post_category'][$c]);
				}
			}else
			{
				$catids_arr[] = 1;
			}
			$my_post['post_title'] = $post_info_arr['post_title'];
			$my_post['post_content'] = $post_info_arr['post_content'];
			if(@$post_info_arr['post_author'])
			{
				$my_post['post_author'] = $post_info_arr['post_author'];
			}else
			{
				$my_post['post_author'] = 1;
			}
			$my_post['post_status'] = 'publish';
			$my_post['post_category'] = $catids_arr;
			$my_post['tags_input'] = $post_info_arr['tags_input'];
			$last_postid = wp_insert_post( $my_post );
			add_post_meta($last_postid,'auto_install', "auto_install");
			$post_meta = @$post_info_arr['post_meta'];
			update_post_meta($last_postid, 'tl_dummy_content',1);
			if($post_meta)
			{
				foreach($post_meta as $mkey=>$mval)
				{
					update_post_meta($last_postid, $mkey, $mval);
				}
			}
			
			$post_image = @$post_info_arr['post_image'];
			if($post_image)
			{
				for($m=0;$m<count($post_image);$m++)
				{
					$menu_order = $m+1;
					$image_name_arr = explode('/',$post_image[$m]);
					$img_name = $image_name_arr[count($image_name_arr)-1];
					$img_name_arr = explode('.',$img_name);
					$post_img = array();
					$post_img['post_title'] = $img_name_arr[0];
					$post_img['post_status'] = 'inherit';
					$post_img['post_parent'] = $last_postid;
					$post_img['post_type'] = 'attachment';
					$post_img['post_mime_type'] = 'image/jpeg';
					$post_img['menu_order'] = $menu_order;
					$last_postimage_id = wp_insert_post( $post_img );
					update_post_meta($last_postimage_id, '_wp_attached_file', $post_image[$m]);					
					$post_attach_arr = array(
										"width"	=>	570,
										"height" =>	400,
										"hwstring_small"=> "height='180' width='140'",
										"file"	=> $post_image[$m],
										//"sizes"=> $sizes_info_array,
										);
					wp_update_attachment_metadata($last_postimage_id, $post_attach_arr );
				}
			}
		}
	}
}
/***- Insert Blog post EOF-***/


/* ========================================= ADDING PAGE TEMPLATES =========================================== */
$pages_array = array();
$pages_array = array('About Us',array('Page Templates','Contact Us', 'Archives', 'Full Width', 'Sitemap'));
$page_info_arr = array();
$page_info_arr['Page Templates'] = '
<p>We are providing the following page templates with this theme : <br>
	<ul style="margin-left:35px;">
		<li> Contact Us</li>
		<li> About Us</li>
		<li> Archives</li>
		<li> Short Codes</li>
		<li> Sitemap</li>
	</ul></p>
<p>You can create a page with a sidebar by using these page templates.</p>
<p>Follow the below steps to use this page tempate in your site : 
	<ul>
		<li>Go to the Dashboard of your site.</li>
		<li>Now, Go to Dashboard >> Pages >> Add New Page. </li>
		<li>Give a title of your choice. Now, you will see "Page Attribute" meta box in the right hand site of the page.<br/><br/>
			Looks like : &nbsp;&nbsp;<img src="'.$dummy_image_path.'add_page.png" >
		</li>
		<li>Now, select a Template from here.</li>
	</ul></p>';
	
$page_info_arr['Contact Us'] = '
<p>Simply designed page template to display a contact form. An easy to use page template to get contacted by the users directly via an email. You can use this page template the same way mentioned in "Page Templates" page. You just need to select <strong>Contact Us</strong> template to use it.</p>';


$page_info_arr['About Us'] = "<p>An <strong>About Us</strong> page template where you can briefly write about the services you provide on your site.</p>
<br />
<strong>What we do?</strong><br /><p>An event is normally a large gathering of people, who have come to a particular place at a particular time for a particular reason. Having said that, there's very little that's normal about an event. In our experience, each one is different and their variety is enormous. And that's as it should be: an event is something special. Aone - off. We plan these occasions in meticulous details, manage them from the ground, dismantle them when they are over and assess the result.</p><br /> <strong>How we do it?</strong><br /> <p>Events can be used to communicate key message, faster community relations, motivate work forces or raise funds. One of the first things we ask our clients is, what they want to achieve from their event. This is the cornerstone of the whole operation for us, our starting point and most importantly, it's the way success can be measured.</p>";

$page_info_arr['Archives'] = 'This is Archives page template. Just select <strong>Page - Archives</strong> page template from templates section and you&rsquo;re good to go.';

$page_info_arr['Sitemap'] =  '
See, how easy is to use page templates. Just add a new page and select <strong>Page - Sitemap</strong> from the page templates section. Easy peasy, isn&rsquo;t it.
';

$page_info_arr['Full Width'] = '

Do you know how easy it is to use Full Width page template ? Just add a new page and select full width page template and you are good to go. Here is a preview of this easy to use page template.

Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus.

Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id, libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut, sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. Donec nec libero.

Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id, libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut, sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. Donec nec libero.

Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id, libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut, sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. Donec nec libero.

Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id, libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut, sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. Donec nec libero.

See, there no sidebar in this template, and that why we call this a full page template. Yes, its this easy to use page templates. Just write any content as per your wish.
';

set_page_info_autorun($pages_array,$page_info_arr);
function set_page_info_autorun($pages_array,$page_info_arr_arg)
{
	global $post_author,$wpdb;
	$last_tt_id = 1;
	if(count($pages_array)>0)
	{
		$page_info_arr = array();
		for($p=0;$p<count($pages_array);$p++)
		{
			if(is_array($pages_array[$p]))
			{
				for($i=0;$i<count($pages_array[$p]);$i++)
				{
					$page_info_arr1 = array();
					$page_info_arr1['post_title'] = $pages_array[$p][$i];
					$page_info_arr1['post_content'] = $page_info_arr_arg[$pages_array[$p][$i]];
					$page_info_arr1['post_parent'] = $pages_array[$p][0];
					$page_info_arr[] = $page_info_arr1;
				}
			}
			else
			{
				$page_info_arr1 = array();
				$page_info_arr1['post_title'] = $pages_array[$p];
				@$page_info_arr1['post_content'] = $page_info_arr_arg[$pages_array[$p]];
				$page_info_arr1['post_parent'] = '';
				$page_info_arr[] = $page_info_arr1;
			}
		}

		if($page_info_arr)
		{
			for($j=0;$j<count($page_info_arr);$j++)
			{
				$post_title = $page_info_arr[$j]['post_title'];
				$post_content = addslashes($page_info_arr[$j]['post_content']);
				$post_parent = $page_info_arr[$j]['post_parent'];
				if($post_parent!='')
				{
					$post_parent_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like \"$post_parent\" and post_type='page'");
				}else
				{
					$post_parent_id = 0;
				}
				$post_date = date('Y-m-d H:s:i');
				
				$post_name = strtolower(str_replace(array('&amp;',"'",'"',"?",".","!","@","#","$","%","^","&","*","(",")","-","+","+"," ",';',',','_','/'),array('','','','','','','','','','','','','','','','','','','','',',','','',''),$post_title));
				$post_name_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title=\"$post_title\" and post_type='page'");
				if($post_name_count>0)
				{
					$post_name = $post_name.'-'.($post_name_count+1);
				}
				$post_id_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='page'");
				if($post_id_count==0)
				{
					$post_sql = "insert into $wpdb->posts (post_author,post_date,post_date_gmt,post_title,post_content,post_name,post_parent,post_type) values (\"$post_author\", \"$post_date\", \"$post_date\",  \"$post_title\", \"$post_content\", \"$post_name\",\"$post_parent_id\",'page')";
					$wpdb->query($post_sql);
					$last_post_id = $wpdb->get_var("SELECT max(ID) FROM $wpdb->posts");
					$guid = home_url()."/?p=$last_post_id";
					$guid_sql = "update $wpdb->posts set guid=\"$guid\" where ID=\"$last_post_id\"";
					$wpdb->query($guid_sql);
					$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$last_tt_id\")";
					$wpdb->query($ter_relation_sql);
					update_post_meta( $last_post_id, 'pt_dummy_content', 1 );
				}
			}
		}
	}
}

//Update the page templates

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Contact Us' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'page-template-contact.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Archives' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'page-template-archives.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Full Width' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'default' );
update_post_meta( $photo_page_id, 'Layout', '1c' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Sitemap' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'page-template-sitemap.php' );

$photo_page_id1 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Short Codes' and post_type='page'");
update_post_meta( $photo_page_id1, '_wp_page_template', 'page-template-short_code.php' );



//PAGE TEMPLATES END

/* ============================================== WIDGET SETTINGS START ================================================ */
 
$sidebars_widgets = get_option('sidebars_widgets');  //collect widget informations
$sidebars_widgets = array();

//FRONT CONTENT WIDGETS ======================================================
// 1. FRONT PAGE SLIDER
$templatic_slider = array();
$templatic_slider[1] = array(
					"title"					=>	'',
					"post_number"	=>	'5',
					);
$templatic_slider['_multiwidget'] = '1';
update_option('widget_anchor_slider',$templatic_slider);
$templatic_slider = get_option('widget_anchor_slider');
krsort($templatic_slider);
foreach($templatic_slider as $key1=>$val1)
{
	$templatic_slider_key = $key1;
	if(is_int($templatic_slider_key))
	{
		break;
	}
}

$sidebars_widgets["homepage-silder"] = array("anchor_slider-$templatic_slider_key");


// anchor_search widgets

$widget_search = array();
$widget_search[1] = array(
					"title"			=>	'',
					"search_submit"	=> '',
					"search_label" => '',
					"search_text" => 'Search Website...',
					"theme_search" => '',
					);
$widget_search['_multiwidget'] = '1';
update_option('widget_hybrid-search',$widget_search);
$widget_search = get_option('widget_hybrid-search');
$sidebars_widgets["header_search"] = array("hybrid-search-1");


	/* Rss Feed widget */
	
	$rss_feed = array();
	$rss_feed[1] = array(
						"title"	 =>	'Rss Feed',
						"id"	 =>	'templatic',
						"text" 	 => 'Latest Blog Posts'
						);
	$rss_feed['_multiwidget'] = '1';
	update_option('widget_widget_rssfeed',$rss_feed);
	$rss_feed = get_option('widget_widget_rssfeed');
	krsort($rss_feed);
	foreach($rss_feed as $key1=>$val1)
	{
		$rss_feed_key = $key1;
		if(is_int($rss_feed_key))
		{
			break;
		}
	}

	// Meta widgets

	$widget_meta = array();
	$widget_meta[1] = array(
						"title"			=>	'Meta',
						);
	$widget_meta['_multiwidget'] = '1';
	update_option('widget_meta',$widget_meta);
	$widget_meta = get_option('widget_meta');


	$sidebars_widgets["primary"] = array("widget_rssfeed-$rss_feed_key","post_by_category-2","$post_by_category_key","hybrid-categories-1","meta-1");
	
	/* Text widget */

	$widget_text = array();
	$widget_text[1] = array(
						"title"			=>	'Some Paragraph',
						"text"			=>	'Text is beautiful, I am talking about big text. This is an example of an introductory paragraph people can use here and there.',
						);
	$widget_text[2] = array(
						"title"			=>	'Statment',
						"text"			=>	'<img src="'.get_stylesheet_directory_uri().'/images/anchor-img.png" class="anchor-img" />This is nothing but example of a taxable widget than can stay here. Big Paragraph might be use for description probably',
						);

	$widget_text['_multiwidget'] = '1';
	update_option('widget_text',$widget_text);
	$widget_text = get_option('widget_text');
	krsort($widget_text);
	foreach($widget_text as $key1=>$val1)
	{
		$widget_text_key = $key1;
		if(is_int($widget_text_key))
		{
			break;
		}
	}

	$sidebars_widgets["footer-one"] = array("text-2","$widget_text_key");
	
	// anchor_category widgets

	$widget_category = array();
	$widget_category[1] = array(
						"title"			=>	'Categories',
						"style"			=> 'list'
						);
	$widget_category['_multiwidget'] = '1';
	update_option('widget_hybrid-categories',$widget_category);
	$widget_category = get_option('widget_hybrid-categories');
	
	$sidebars_widgets["footer-second"] = array("hybrid-categories-1");
	
	// anchor_tags widgets

	$widget_tags = array();
	$widget_tags[1] = array(
						"title"			=>	'Tags'
						);
	$widget_tags['_multiwidget'] = '1';
	update_option('widget_hybrid-tags',$widget_tags);
	$widget_tags = get_option('widget_hybrid-tags');
	
	$sidebars_widgets["footer-third"] = array("hybrid-tags-1");

	
	// anchor_meta widgets

	$widget_meta = array();
	$widget_meta[1] = array(
						"title"			=>	'Meta',
						);
	$widget_meta['_multiwidget'] = '1';
	update_option('widget_meta',$widget_meta);
	$widget_meta = get_option('widget_meta');
	
	$sidebars_widgets["footer-fourth"] = array("meta-1");
	
	
	// anchor_pages widgets

	$widget_pages = array();
	$widget_pages[1] = array(
						"title"			=>	'Pages',
						);
	$widget_pages['_multiwidget'] = '1';
	update_option('widget_hybrid-pages',$widget_pages);
	$widget_pages = get_option('widget_hybrid-pages');
	
	$sidebars_widgets["footer-fifth"] = array("hybrid-pages-1");
	
	
	/* Listing Post widget */

	$listing_post = array();
	$listing_post[1] = array(
						"title"			=>	'Latest Blog',
						"category_slug"			=>	'blog',
						"order"  => 'DESC'
						);
	$listing_post['_multiwidget'] = '1';
	update_option('widget_anchor_recent_post',$listing_post);
	$listing_post = get_option('widget_anchor_recent_post');
	krsort($listing_post);
	foreach($listing_post as $key1=>$val1)
	{
		$listing_post_key = $key1;
		if(is_int($listing_post_key))
		{
			break;
		}
	}
	$sidebars_widgets["home_content_area"] = array("anchor_recent_post-$listing_post_key");
	
	// Location widgets

	$widget_location_anchor = array();
	$widget_location_anchor[1] = array(
						"title"			=>	'Location',
						"address"			=>	'Newyork,USA',
						);
	$widget_location_anchor['_multiwidget'] = '1';
	update_option('widget_location',$widget_location_anchor);
	$widget_location_anchor = get_option('widget_location');
	krsort($widget_location_anchor);
	foreach($widget_location_anchor as $key1=>$val1)
	{
		$widget_location_anchor_key = $key1;
		if(is_int($widget_location_anchor_key))
		{
			break;
		}
	}

	$sidebars_widgets["header_right"] = array();

	$sidebars_widgets["header_right"] = array("location-$widget_location_anchor_key");
	
	// widget_subscribewidget widgets
	
	$widget_subscribewidget = array();
	$widget_subscribewidget[1] = array(
						'id' => '',
						'title' => 'SUBSCRIBE TO OUR NEWSLETTER',
						'text' => '',
						);
	$widget_subscribewidget['_multiwidget'] = '1';
	update_option('widget_subscribewidget',$widget_subscribewidget);
	$widget_subscribewidget = get_option('widget_subscribewidget');
	krsort($widget_subscribewidget);
	foreach($widget_subscribewidget as $key1=>$val1)
	{
		$widget_subscribewidget_key = $key1;
		if(is_int($widget_subscribewidget_key))
		{
			break;
		}
	}

// social_media widgets

$social_media = array();
$social_media[1] = array(
					"title"			=>	'STAY CONNECTED',
					"twitter"		=>	'http://www.twitter.com/templatic',
					"facebook"		=>	'http://www.facebook.com/templatic',
					"linkedin"		=>	'http://www.linkedin.com/templatic',
					"rss"			=>	'http://templatic.com/feed',
					"myspace"		=>  '#',
					"flickr" 		=>  'http://flicker.com/templatic',
					"youtube"		=>  'http://youtube.com/templatic',
					"googleplus"	=>  '#',
					);
$social_media['_multiwidget'] = '1';
update_option('widget_social_media',$social_media);
$social_media = get_option('widget_social_media');
krsort($social_media);
foreach($social_media as $key1=>$val1)
{
	$social_media_key = $key1;
	if(is_int($social_media_key))
	{
		break;
	}
}

$sidebars_widgets["after_header"] = array("subscribewidget-1","$widget_subscribewidget_key","social_media-$social_media_key");


// 2. Post By Category WIDGET
$post_by_category = array();
$post_by_category[1] = array(
					"title"			=>	'',
					"category_slug"			=>	'blog,events,festivals',
					);
$post_by_category[2] = array(
					"title"			=>	'Featured Post',
					"category_slug"			=>	'festivals',
					);
$post_by_category['_multiwidget'] = '1';
update_option('widget_post_by_category',$post_by_category);
$post_by_category = get_option('widget_post_by_category');
krsort($post_by_category);
foreach($post_by_category as $key1=>$val1)
{
	$post_by_category_key = $key1;
	if(is_int($post_by_category_key))
	{
		break;
	}
}

/* Text and button widget */

$text_button = array();
$text_button[1] = array(
					"text"			=>	"<b>Things looking good already?</b> Don't hesitate any other second.",
					"button_text"			=>	'Sign Up',
					"button_url" => '#'
					);
$text_button['_multiwidget'] = '1';
update_option('widget_text_button',$text_button);
$text_button = get_option('widget_text_button');
krsort($text_button);
foreach($text_button as $key1=>$val1)
{
	$text_button_key = $key1;
	if(is_int($text_button_key))
	{
		break;
	}
}

/* Tabber widget */

$tabber = array();
$tabber[1] = array(
					"title_text"			=>	array('Subscriptions','Notes','Cloude Service','Nasty Icon'),
					"content_area"			=>	array('<p>Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p><p>Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p><p>Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p>','<p>The theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p><p>The theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p>','<p>Piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p><p>Piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p><p>Piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p>','<p>Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p><p>Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p><p>Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is a piece of cake but since we get a lot of request from customers new to Wordpress here is Installing the theme is a piece of cake but since we get a lot of request from customers new to Wordpress here is</p>'),
					"img_url" => array(get_stylesheet_directory_uri()."/images/tabber_icon_1.png",get_stylesheet_directory_uri()."/images/tabber_icon_2.png",get_stylesheet_directory_uri()."/images/tabber_icon_3.png",get_stylesheet_directory_uri()."/images/tabber_icon_4.png"),
					);
$tabber['_multiwidget'] = '1';
update_option('widget_anchor_tabber',$tabber);
$tabber = get_option('widget_anchor_tabber');
krsort($tabber);
foreach($tabber as $key1=>$val1)
{
	$tabber_key = $key1;
	if(is_int($tabber_key))
	{
		break;
	}
}
$sidebars_widgets["subsidiary"] = array("text-1","$widget_text_key","post_by_category-1","$post_by_category_key","anchor_tabber-$tabber_key","text_button-$text_button_key");


// 2. Post By Category WIDGET

$testimonials = array();
$testimonials[1] = array(
					"title"	=>	'',
					'fadin' => '1000',
					"fadout" =>	'1000',
					"transition" => 'fade',
					"transition"        =>   'fade',
					"quotetext"			=>   array('lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet','lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet','lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet','lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpatorem ipsum dolor sit amet','lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt'),
					"author"			=>	array(' R. Bhavesh',' John Smith',' Steven',' Linda',' Brain Storm'),
					"link_text"			=> 'More reviews and buzz &raquo;',
					"link_url"			=> 'http://templatic.com'
					);
$testimonials['_multiwidget'] = '1';
update_option('widget_testimonials_widget',$testimonials);
$testimonials = get_option('widget_testimonials_widget');
krsort($testimonials);
foreach($testimonials as $key1=>$val1)
{
	$testimonials_key = $key1;
	if(is_int($testimonials_key))
	{
		break;
	}
}

$sidebars_widgets["subsidiary-2c"] = array("testimonials_widget-$testimonials_key","hybrid-categories-1");
update_option('sidebars_widgets',$sidebars_widgets);  //save widget iformations


/////////////// WIDGET SETTINGS END ///////////////





/* ======================== CODE TO ADD RESIZED IMAGES ======================= */
regenerate_all_attachment_sizes();
 
function regenerate_all_attachment_sizes() {
	$args = array( 'post_type' => 'attachment', 'numberposts' => 100, 'post_status' => 'attachment'); 
	$attachments = get_posts( $args );
	if ($attachments) {
		foreach ( $attachments as $post ) {
			$file = get_attached_file( $post->ID );
			wp_update_attachment_metadata( $post->ID, wp_generate_attachment_metadata( $post->ID, $file ) );
		}
	}		
}

?>
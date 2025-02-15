<?php echo view('nicheone/layouts/common/header'); ?>
<meta property="og:updated_time" content="<?=formatDateTime($blog['update_date']);?>" />
<meta property="article:published_time" content="<?=formatDateTime($blog['publish_date']);?>" />
<meta property="article:modified_time" content="<?=formatDateTime($blog['update_date']);?>" />
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "<?=siteSet('site_name');?>",
    "item": "<?=getenv('app.baseURL');?>"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "<?=$blog['title'];?>",
    "item": "<?=current_url(false);?>"
  }]
}
</script>
<script type="application/ld+json">
[{
   "@context": "https://schema.org",
   "@type": "ImageObject",
   "contentUrl": "<?=getBlogImage($blog['image']);?>",
   "license": "<?=getenv('app.baseURL');?>",
   "acquireLicensePage": "<?=getenv('app.baseURL');?>"
}]
</script>

<?php
$json_ld = '
<script type="application/ld+json">
{
   "@context": "https://schema.org",
   "@type": "BlogPosting",
   "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "'.current_url(false).'"
   },
   "headline": "'.$blog['title'].'",
   "image": {
      "@type": "ImageObject",
      "url": "'.getBlogImage($blog['image']).'"
   },
   "datePublished": "'.formatDateTime($blog['publish_date']).'",
   "dateModified": "'.formatDateTime($blog['update_date']).'",
   "author": [{
      "@type": "Person",
      "name": "'.$author['author_name'].'",
      "url": "'.getenv('app.baseURL').'",
      "jobTitle": "'.$author['author_expertise'].'",
      "description": "'.$author['author_bio'].'"
   }],

   "publisher": {
      "@type": "Organization",
      "name": "'.siteSet('site_name').'",
      "logo": {
         "@type": "ImageObject",
         "url": "'.getenv('site.cdnUrl').'/public/upload/logo/'.siteSet('site_logo').'"
      }
   },

   "description": "'.$blog['description'].'"';

$json_ld.= ',"commentCount": "'.count($comments).'",';
$json_ld.= '"comment": [';
foreach ($comments as $key => $comment) {
     $json_ld.='{';
    $json_ld.= '"@type": "Comment",';
    $json_ld.= '"author": "'.$comment['nick_name'].'",';
    $json_ld.= '"datePublished": "'.formatDateTime($comment['create_date']).'",';
    $json_ld.= '"text": "'.$comment['comment_text'].'"';
    $json_ld.= '}';
    if ($key != count($comments) - 1) {
        $json_ld.= ',';
    }
}
$json_ld.= ']';

$json_ld.= '} </script>';
echo $json_ld;
?>

<?php
if (!empty($blog['youtube_id'])) {
  echo '<script type="application/ld+json">';
  
  if (!empty($blog['YoutubeTitle'])) { $video_title = $blog['YoutubeTitle']; } else { $video_title = $blog['title']; }
  
  $video_data = array(
     '@context' => 'https://schema.org',
     '@type' => 'VideoObject',
     'name' => $video_title,
     'description' => $video_title,
     'thumbnailUrl' => 'https://i.ytimg.com/vi/'.$blog['youtube_id'].'/mqdefault.jpg',
     'contentUrl' => 'https://www.youtube.com/watch?v='.$blog['youtube_id'],
     'embedUrl' => 'https://www.youtube.com/embed/'.$blog['youtube_id'],
     'uploadDate' => date('Y-m-d', strtotime($blog['publish_date']))

  );

  if (!empty($blog['YoutubeDuration'])) { $video_data['duration'] = convertDuration($blog['YoutubeDuration']); }


  $json_video_data = json_encode($video_data);
  echo $json_video_data;
}
echo '</script>';
?>

<?php if (!empty($blog['content_images'])) { ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ImageObject",
  "contentUrl": "<?=getBlogContentImage($blog['content_images']);?>",
  "description": "<?=$blog['title'];?>"
}
</script>
<?php } ?>

<?php 
if (!empty($blog['questions'])) {
    $blog_q1 = str_replace('"questions": ', '', $blog['questions']);
  //$blog_q1 = str_replace('[{', '[', $blog_q1);
  //$blog_q1 = str_replace('}]', ']', $blog_q1);
  //print_r($blog_q1);
  //exit();
  $blog_q = json_decode($blog_q1, true);

  if ($blog_q === null) { $blog_q = []; }
    if (!empty($blog_q)) {
    echo '<script type="application/ld+json">';
    $faq_data = array(
       '@context' => 'https://schema.org',
       '@type' => 'FAQPage',
       '@id' => current_url(false),
       'mainEntity' => array()
    );



    foreach ($blog_q as $item) {

       $faq_data['mainEntity'][] = array(
          '@type' => 'Question',
          'name' => $item['question'],
          'acceptedAnswer' => array(
             '@type' => 'Answer',
             'text' => $item['answer']
          )
       );
    }

    $json_faq = json_encode($faq_data);
    echo $json_faq;

    echo '</script>';
  }
}
?>
<style>
/* Style the table of contents */
.table-of-contents {
  background-color: #f5f5f5;
  border: 1px solid #ddd;
  padding: 10px;
  margin-bottom: 20px;
}

.table-of-contents ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.table-of-contents li {
  margin: 5px 0;
}

.table-of-contents a {
  text-decoration: none;
  color: #333;
}

.table-of-contents a:hover {
  color: #666;
}

iframe {
  width: 100%;
  height: 400px;
}
.contentImage {width: 100%; height: auto;border:1px Solid #ccc;padding:10px;border-radius:7px;}
.author-info {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
}

.author-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  overflow: hidden;
  margin-right: 10px;
}

.author-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.author-name {
  font-weight: 500;
  font-size: 15px;
  margin-bottom: 5px;
}

.author-expertise {
  font-size: 13px;
  color: #6c757d;
  margin-bottom: 10px;
}

.author-bio {
  font-size:13px;
  margin-left: 60px;
  margin-right: 30px;
}

.author-box {
      border-top: 1px solid #ccc;
    padding-top: 10px;
}
</style>
<section class="album py-5 bg-light">
  <div class="container">
    <div class="row" itemscope itemtype="http://schema.org/Blog">
      <div class="col-md-8 mx-auto">
        <div class="card mb-4 shadow-sm">
          <img src="<?=getBlogImage();?>" data-original="<?=getBlogImage($blog['image']);?>" itemprop="image" class="bd-placeholder-img card-img-top lazy" style="height: auto; width: 100%;" role="img" aria-label="<?=$blog['title'];?>" alt="<?=$blog['title'];?>" preserveAspectRatio="xMidYMid slice" focusable="false">
          <div class="card-body">
            <h2 class="card-title" itemprop="headline"><?=$blog['title'];?></h2>
            <p class="card-text"><?=$blog['description'];?></p>
            <div class="d-flex justify-content-between align-items-center"><small class="text-muted"><?=trtarih($blog['update_date']);?></small></div>
        <?php if (array_key_exists("_id", $author)) { ?>
            <div class="author-box mt-2">
              <div class="author-info" itemscope itemtype="https://schema.org/Person">
                <div class="author-avatar"><img src="<?=getAuthorAvatarImage($author['avatar_image']);?>" alt="<?=$author['author_name'];?>" itemprop="image"></div>
                <div class="author-details">
                  <div class="author-name" itemprop="name"><?=$author['author_name'];?></div>
                  <div class="author-expertise" itemprop="jobTitle"><?=$author['author_expertise'];?></div>
                </div>
              </div>
              <div class="author-bio" itemprop="description"><?=$author['author_bio'];?></div>
            </div>
        <?php } ?>
          </div>
        </div>
        <div itemprop="text"><?=add_headings(insert_image_at_interval($blog['content'], 3, $blog['title'], getBlogContentImage($blog['content_images'])))?></div>
        <?php if (!empty($blog['youtube_id'])) {
          echo '<div><iframe width="100%" height="400" src="https://www.youtube.com/embed/'.$blog['youtube_id'].'" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>';
        } ?>
        <?php if (!empty($blog['questions']) AND (!empty($blog_q))) { ?>
        <div class="faq mt-2">
          <h4><?=lang('Site.blog.faq_text');?></h4>
          <div class="accordion" id="faqAccordion">
          <?php 
            $faq_i=1;
            foreach ($blog_q as $item) {

              echo '<div class="accordion-item">
                    <h5 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem'.$faq_i.'">'.$item['question'].'</button></h5>
                    <div id="faqItem'.$faq_i.'" class="accordion-collapse collapse"><div class="accordion-body">'.$item['answer'].'</div></div>
                  </div>';
              $faq_i++;
            }
          ?>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
<?php if (siteSet('blog_comments') == 'active') { ?>
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h4 class="mb-3"><?=lang('Site.comments.title_text');?></h4>
      <div class="mb-3">
      <?php foreach ($comments as $comment) { ?>
        <div itemscope itemtype="https://schema.org/Comment" class="card mt-3">
          <div class="card-header">
            <h5 class="card-title" itemprop="author"><?=$comment['nick_name'];?></h5>
            <small class="text-muted"><time itemprop="dateCreated" datetime="<?=formatDateTime($comment['update_date']);?>"><?=trtarih($comment['update_date']);?></time></small>
          </div>
          <div class="card-body">
            <p class="card-text" itemprop="text"><?=$comment['comment_text'];?></p>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
<?php if (siteSet('blog_comment_userform') == 'active') { ?>
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h3 class="mb-3"><?=lang('Site.comments.write_title_text');?></h3>
      <form>
        <div class="mb-3">
          <label for="name" class="form-label"><?=lang('Site.comments.name_text');?></label>
          <input type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label"><?=lang('Site.comments.email_text');?></label>
          <input type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
          <label for="comment" class="form-label"><?=lang('Site.comments.comment_text');?></label>
          <textarea class="form-control" id="comment" rows="5" required></textarea>
        </div>
        <span id="submit_comment" class="btn btn-primary"><?=lang('Site.comments.submit_button_text');?></span>
      </form>
      <div id="comment-message" class="text-center mt-2 alert"></div>
    </div>
  </div>
<?php } ?>
<?php } ?>
  </div>
</section>

<section class="bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-4"><?=lang('Site.blog.related_posts_text');?></h2>
          </div>
        </div>
        <div class="row">
        <?php foreach ($related_blogs as $r_blog) { ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <a href="<?=getblogSeoUrl($r_blog->seo_name, $r_blog->_id);?>" title="<?=$r_blog->title?>"><img src="<?=getBlogImage();?>" data-original="<?=getBlogImage($r_blog->image);?>" class="card-img-top lazy" alt="<?=$r_blog->title?>"></a>
              <div class="card-body">
                <div class="card-title fw-bold"><a href="<?=getblogSeoUrl($r_blog->seo_name, $r_blog->_id);?>" title="<?=$r_blog->title?>"><?=$r_blog->title?></a></div>
                <p class="card-text"><?=$r_blog->description;?></p>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo view('nicheone/layouts/common/footer'); ?>
<?php if (siteSet('recaptcha_status') == 'active') { ?>
<script>
$(document).ready(function() {
    // submit_comment butonuna tıklanıldığında
    $('#submit_comment').click(function(event) {
        event.preventDefault();

        grecaptcha.execute('<?=siteSet('recaptcha_site_key')?>', {action: 'submit_comment'}).then(function(token) {
            // Doğrulama skoru sunucuya gönderilir ve yorumu kaydetmek için bir API isteği yapılır.
            $.ajax({
                url: 'submit_comment',
                type: 'POST',
                data: {
                    'recaptcha': token,
                    'name': $('#name').val(),
                    'blog_id': <?=$blog['_id']?>,
                    'email': $('#email').val(),
                    'comment': $('#comment').val()
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status == 'success') {
                        $('#comment-message').removeClass('alert-danger').addClass('alert-success').text(data.message).show();
                    } else {
                        $('#comment-message').removeClass('alert-success').addClass('alert-danger').text('<?=lang('Site.error_text');?>: ' + data.message).show();
                    }
                    $('#name').val('');
                    $('#email').val('');
                    $('#comment').val('');
                },
                error: function(response) {
                    $('#comment-message').removeClass('alert-success').addClass('alert-danger').text('<?=lang('Site.error_try_again_text');?>').show();
                }
            });
        });
    });
});
</script>

<?php } ?>

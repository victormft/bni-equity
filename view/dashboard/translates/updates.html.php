<?php

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Library\SuperForm;

define('ADMIN_NOAUTOSAVE', true);

$blog  = $this['blog'];
$posts = $this['posts'];

$errors = $this['errors'];

?>
<?php if ($this['action'] == 'list') : ?>
<div class="widget">
    <!-- lista -->
    <?php if (!empty($posts)) : ?>
    <?php foreach ($posts as $post) : ?>
        <div class="post">
            <a class="button" href="<?php echo SITE_URL ?>/dashboard/translates/updates/edit/<?php echo $post->id; ?>"><?php echo Text::get('regular-edit') ?></a>&nbsp;&nbsp;&nbsp;
            <span><?php echo $post->publish ? Text::get('regular-published_yes') : Text::get('regular-published_no'); ?></span>
            <strong><?php echo $post->title; ?></strong>
            <span><?php echo $post->date; ?></span>
        </div>
    <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo Text::get('blog-no_posts') ?></p>
    <?php endif; ?>

</div>

<?php  else : // sueprform!

        $post  = $this['post']; // si edit
        $original = \Equity\Model\Blog\Post::get($post->id);


        if (!empty($post->media->url)) {
            $media = array(
                    'type'  => 'media',
                    'title' => Text::get('overview-field-media_preview'),
                    'class' => 'inline media',
                    'type'  => 'html',
                    'html'  => !empty($post->media) ? $post->media->getEmbedCode() : ''
            );
        } else {
            $media = array(
                'type'  => 'hidden',
                'class' => 'inline'
            );


        }


    ?>

    <form method="post" action="<?php echo SITE_URL ?>/dashboard/translates/updates/save/<?php echo $post->id; ?>" class="project" enctype="multipart/form-data">

    <?php echo new SuperForm(array(

        'action'        => '',
        'level'         => 3,
        'method'        => 'post',
        'title'         => '',
        'hint'          => Text::get('guide-project-updates'),
        'class'         => 'aqua',
        'footer'        => array(
            'view-step-preview' => array(
                'type'  => 'submit',
                'name'  => 'save-post',
                'label' => Text::get('regular-save'),
                'class' => 'next'
            )
        ),
        'elements'      => array(
            'id' => array (
                'type' => 'hidden',
                'value' => $post->id
            ),
            'blog' => array (
                'type' => 'hidden',
                'value' => $post->blog
            ),
            'title-orig' => array(
                'type'      => 'html',
                'title'     => 'Título',
                'html'      => $original->title,
            ),
            'title' => array(
                'type'      => 'textbox',
                'size'      => 20,
                'class'     => 'inline',
                'title'     => '',
                'hint'      => Text::get('tooltip-updates-title'),
                'errors'    => array(),
                'value'     => $post->title,
            ),
            'text-orig' => array(
                'type'      => 'html',
                'title'     => 'Texto de la entrada',
                'html'      => nl2br($original->text)
            ),
            'text' => array(
                'type'      => 'textarea',
                'cols'      => 40,
                'rows'      => 4,
                'class'     => 'inline',
                'title'     => '',
                'hint'      => Text::get('tooltip-updates-text'),
                'errors'    => array(),
                'value'     => $post->text
            ),

            'media-orig' => array(
                'type'      => 'html',
                'title'     => 'Vídeo',
                'html'     => (string) $original->media->url
            ),
            'media' => array(
                'type'      => 'textbox',
                'title'     => '',
                'class'     => 'inline media',
                'hint'      => Text::get('tooltip-updates-media'),
                'errors'    => array(),
                'value'     => (string) $post->media
            ),
            
            'media-upload' => array(
                'name' => "upload",
                'type'  => 'submit',
                'label' => Text::get('form-upload-button'),
                'class' => 'inline media-upload'
            ),

            'media-preview' => $media,

            'legend-orig' => array(
                'type'      => 'html',
                'title'     => Text::get('regular-media_legend'),
                'html'     => nl2br($original->legend),
            ),
            'legend' => array(
                'type'      => 'textarea',
                'title'     => '',
                'class'     => 'inline',
                'value'     => $post->legend,
            )

        )

    ));
    ?>

    </form>

<?php endif; ?>
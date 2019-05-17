<?php
namespace Anax\View;

if (!$resultset) {
    return;
}
?>

<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="blog/<?= e($row->slug) ?>"><?= e($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= e($row->published_iso8601) ?>" pubdate><?= e($row->published) ?></time></i></p>
    </header>
    <?= e($row->data) ?>
</section>
<?php endforeach; ?>

</article>

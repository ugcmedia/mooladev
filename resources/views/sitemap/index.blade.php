<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach($sitemaps as $sitemap) { ?>
    <sitemap>
        <loc><?php echo url('/');?>/sitemap/<?php echo $sitemap->slug;?> </loc>
        <lastmod>{{  date('c', strtotime($sitemap->updated_date) ) }}</lastmod>
    </sitemap>
<?php }?>   
</sitemapindex>
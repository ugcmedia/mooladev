<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($entries as $entry)
        <url>
            <loc>{{url('/')}}{{ $slug }}/{{ $entry->slug }}</loc>
            <lastmod>{{  date('c', strtotime($entry->updated_date) ) }}</lastmod>
            <changefreq>{{ $subsetting->frequency }}</changefreq>
            <priority>{{ $subsetting->priority }}</priority>
        </url>
    @endforeach
</urlset>
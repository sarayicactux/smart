<?php

    $newquery               = 'جزوه ادبیات سال سوم';

    $googledata             = $newGoogleRankChecker->find($newquery, $useproxies, $arrayproxies);


    foreach ($googledata as $result) {
        $rank = New \App\Models\rank();
        $rank->keyword = $newquery;
        $rank->rank = $result['rank'];
        $rank->url = $result['url'];
        $rank->save();

    }
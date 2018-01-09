<?php

/*
Template Name: Default Ranking
*/

use HigherEducation\Pub\PublicHelpers;

$client         = new \AlgoliaSearch\Client(ALGOLIA_APP_ID, ALGOLIA_API_KEY);
$index_rankings = $client->initIndex(ALGOLIA_RANKINGS);
$index_items    = $client->initIndex(ALGOLIA_RANKINGS_ITEMS);
$expand_top     = !empty($expand_top) ? $expand_top : 5;
$limit          = !empty($preview_top) ? $preview_top : 100;
$expand_all     = !empty($expand_all) && ($expand_all == 1 || $expand_all == 'true') ? ' is-expanded-all' : '';
$ranking        = $index_rankings->getObject($id, 'title,ranking_cpt_slug');

$rows = $index_items->search('', [
    'filters'     => 'post_id:' . $id,
    'hitsPerPage' => $limit,
]);

// Return if no hits.
if (empty($rows['hits'])) {
    return;
}

?>

<table class="rankings js-children-toggle<?php echo $expand_all; ?>">

    <?php if (!empty($ranking['title'])) : ?>
        <caption class="header">
            <?php echo $ranking['title']; ?>
            <div class="btn-controls">
                <button type="button" class="js-collapse-all">Collapse All</button>
                <button type="button" class="js-expand-all">Expand All</button>
            </div>
        </caption>
    <?php endif; ?>

    <thead class="hide">
        <tr>
            <th>Rank</th>
            <th>School</th>
            <th>Score</th>
            <th>Toggle</th>
            <th>Content</th>
        </tr>
    </thead>

    <?php 
    foreach($rows['hits'] as $k => $hit) : 

        extract($hit);

        $stats = [
            'tuition' => [
                'icon'  => 'icon-tuition',
                'label' => 'Average Tuition',
                'value' => !empty($tuition) ? '$' . number_format(str_replace(',', '', $tuition)) : false,
            ],
            'students_receiving_financial_aid' => [
                'icon'  => 'icon-coin-stack',
                'label' => 'Students Receiving Financial Aid',
                'value' => !empty($pct_receiving_loans) ? $pct_receiving_loans . '%' : false,
            ],
            'net_price' => [
                'icon'  => 'icon-calculator',
                'label' => 'Net Price',
                'value' => !empty($avg_net_price) ? '$' . number_format(str_replace(',', '', $avg_net_price)) : false,
            ],
            'graduation_rate' => [
                'icon'  => 'icon-cap',
                'label' => 'Graduation Rate',
                'value' => !empty($graduation_rate) ? $graduation_rate . '%' : false,
            ],
            'student_to_faculty_ratio' => [
                'icon'  => 'icon-pie-graph',
                'label' => 'Student to Faculty Ratio',
                'value' => !empty($student_faculty_ratio) ? $student_faculty_ratio . ':1' : false,
            ],
            'admissions_rate' => [
                'icon'  => 'icon-star-solid',
                'label' => 'Admissions Rate',
                'value' => !empty($admissions_rate) ? $admissions_rate . '%' : false,
            ],
            'enrollment_rate' => [
                'icon'  => 'icon-door',
                'label' => 'Enrollment Rate',
                'value' => !empty($enrollment_rate) ? $enrollment_rate . '%' : false,
            ],
            'retention_rate' => [
                'icon'  => 'icon-trophy-solid',
                'label' => 'Retention Rate',
                'value' => !empty($retention_rate) ? $retention_rate . '%' : false,
            ],
            'percentage_of_students_in_online_programs' => [
                'icon'  => 'icon-pulse',
                'label' => 'Percentage of Students in Online Programs',
                'value' => !empty($online_enrollment) ? $online_enrollment . '%' : false,
            ],
            'number_of_programs' => [
                'icon'  => 'icon-stack', 
                'label' => 'Number of Campus Programs',
                'value' => !empty($number_of_campus_programs) ? number_format(str_replace(',', '', $number_of_campus_programs)) : false,
            ],
            'number_of_programs' => [
                'icon'  => 'icon-stack', 
                'label' => 'Number of Online Programs',
                'value' => !empty($number_of_online_programs) ? number_format(str_replace(',', '', $number_of_online_programs)) : false,
            ],        
            'lms' => [
                'icon'  => 'icon-clipboard',
                'label' => 'LMS',
                'value' => !empty($lms) ? $lms : false,
            ],
            'part_time_cost_per_credit_hour' => [
                'icon'  => 'icon-parttime-cost',
                'label' => 'Part-time cost per credit hour',
                'value' => !empty($per_credit_hour_parttime_graduate) ? '$' . number_format(str_replace(',', '', $per_credit_hour_parttime_graduate)) : false,
            ]
        ];

        // Check for Meta.
        $metaClass = '';

        if (
            !empty($tuition) || 
            !empty($pct_receiving_loans) || 
            !empty($avg_net_price) ||
            !empty($per_credit_hour_parttime_graduate) || 
            !empty($lms) || 
            !empty($number_of_online_programs) || 
            !empty($number_of_campus_programs) || 
            !empty($online_enrollment) ||
            !empty($retention_rate) ||
            !empty($enrollment_rate) || 
            !empty($admissions_rate) ||
            !empty($student_faculty_ratio) ||
            !empty($graduation_rate)
        ) {
            $metaClass = ' has-meta';
        }
        ?>

        <tr class="js-target <?php if (!empty($expand_all) || $row <= $expand_top) { echo 'is-active'; } ?>">
            <td class="rank js-toggle"><?php echo $rank; ?></td>
            <td class="title js-toggle<?php if (!empty($score)) { echo ' has-score'; } ?>"><h4><?php echo $school; ?></h4></td>
            <?php if (!empty($score)) : ?>
            <td class="score js-toggle">
                <span class="score-content">
                    <span class="label">Score</span>
                    <span class="number"><strong><?php echo $score; ?></strong></span>
                </span>
            </td>
            <?php endif; ?>
            <td class="toggle js-toggle"><?php echo PublicHelpers::get_svg('icon-expand'); ?></td>
            <td class="content<?php echo $metaClass; ?>">
                <?php 
                if ($k == 0 && !empty($image_url) && !wp_is_mobile()) {
                    echo '<img class="image" src="' . str_replace('upload/', 'upload/ar_3.92,c_fill,w_940,q_65/', $image_url) . '" />';
                }
                ?>

                <?php if (!empty($metaClass)) : ?>
                <div class="meta js-target">
                    <?php
                    $count = 0;
                    foreach ($stats as $stat => $attr) : 
                        if (!empty($attr['value']) && $attr['value'] != 'false') :
                    ?>

                            <div class="stat-<?php echo $stat; ?>">
                                <?php echo do_shortcode('[icon value="' . $attr['icon'] . '"]'); ?>
                                <span class="label"><?php echo $attr['label']; ?></span>
                                <?php echo $attr['value']; ?>
                            </div>

                        <?php
                            $count++;
                        endif; 
                    endforeach;
                    if ($count > 4) echo '<a class="btn-link js-toggle"></a>';
                    ?>
                </div>
                <?php endif; ?>

                <div class="description">
                    <?php
                    if ($k != 0 && !empty($image_url) && !wp_is_mobile()) {
                        echo '<img class="image" src="' . str_replace( 'upload/', 'upload/ar_3.92,c_fill,w_940,q_65/', $image_url ) . '" />';
                    }

                    if (!empty($copy)) {
                        echo $copy;
                    }

                    $url = !empty( $program_url ) ? $program_url : $domain;

                    if (!empty($url)) {
                        $url = parse_url($url, PHP_URL_SCHEME) === null ? 'http://' . $url : $url;
                        echo '<a class="btn-tertiary" href="' . $url . '" target="_blank" rel="nofollow">Visit School Website</a>';
                    }
                    ?>
                </div>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

<?php if(!empty($preview_top)) : ?>
    <p class="rankings-preview">
        <a class="btn btn-critical" href="<?php echo $ranking['ranking_cpt_slug']; ?>">View Complete Ranking</a>
    </p>
<?php endif; ?>  

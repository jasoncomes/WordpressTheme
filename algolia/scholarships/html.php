<div class="algolia-scholarships">

    <!-- Filters -->
    <div class="filters">

        <form class="filter-form">

            <div class="filter-title">Search Rankings</div>
            <div id="algolia-searchBox"></div>
            
            <div class="filter-title">Filter Options</div>
            <div class="filter-section js-target">

                <div class="filter-control js-toggle"></div>

                <div class="filter-category">
                    <div class="filter-label js-toggle-category">Location</div>
                    <div class="filter-options" id="algolia-refinementList-state"></div>
                </div>

                <div class="filter-category">
                    <div class="filter-label js-toggle-category">Popular Study Areas</div>
                    <div class="filter-options" id="algolia-toggleList-study_areas"></div>
                </div>

                <div class="filter-category">
                    <div class="filter-label js-toggle-category">Sponsored by School</div>
                    <div class="filter-options" id="algolia-toggleList-sponsor-is_school"></div>
                </div>

                <div class="filter-category">
                    <div class="filter-label js-toggle-category">Renewability</div>
                    <div class="filter-options" id="algolia-toggleList-renewable"></div>
                </div>

                <div class="filter-category">
                    <div class="filter-label js-toggle-category">Minimum GPA</div>
                    <div class="filter-options" id="algolia-refinementList-min_gpa"></div>
                </div>

                <div class="filter-category">
                    <div class="filter-label js-toggle-category">Ethnicity Preference</div>
                    <div class="filter-options" id="algolia-refinementList-races"></div>
                </div>

                <div class="filter-category">
                    <div class="filter-label js-toggle-category">Enrollment Level</div>
                    <div class="filter-options" id="algolia-refinementList-enroll_level"></div>
                </div>

            </div>

            <div id="algolia-clearAll"></div>

        </form>

    </div>

    <!-- Title/Hits/Pagination -->
    <div class="results list js-children-toggle">

        <div id="algolia-currentRefinedValues"></div>

        <h3 class="header">

            <?php echo !empty($title) ? $title : 'Scholarships'; ?>

            <div class="result-stats">
                <div class="result-count" id="algolia-count"></div>
            </div>

            <div class="btn-controls">
                <button type="button" class="btn-toggle js-collapse-all">Collapse All</button>
                <button type="button" class="btn-toggle js-expand-all">Expand All</button>
            </div>

        </h3>

        <div id="algolia-hits" class="scholarships"></div>
        <div class="algolia-pagination" id="algolia-pagination"></div>

    </div>

</div>

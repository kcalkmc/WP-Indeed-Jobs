<form class="form-horizontal" id="indeed-job-search-form" action="#" method="post">
    <fieldset>
        <legend><?php esc_attr_e( 'Search for jobs', 'wp-indeed-jobs' ); ?></legend>
        <div class="control-group">
            <label class="control-label" for="as_and"><?php esc_attr_e( 'With all of these words:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input type="text" id="as_and" name="as_and" placeholder="<?php esc_attr_e( 'ex: WordPress developer or receptionist', 'wp-indeed-jobs' ); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="as_phr"><?php esc_attr_e( 'With the exact phrase:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input type="text" id="as_phr" name="as_phr" placeholder="<?php esc_attr_e( 'ex: WordPress developer or receptionist', 'wp-indeed-jobs' ); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="as_any"><?php esc_attr_e( 'With at least one of these words:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input type="text" id="as_any" name="as_any" placeholder="<?php esc_attr_e( 'ex: WordPress developer or receptionist', 'wp-indeed-jobs' ); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="as_not"><?php esc_attr_e( 'With none of these words:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input type="text" id="as_not" name="as_not" placeholder="<?php esc_attr_e( 'ex: WordPress developer or receptionist', 'wp-indeed-jobs' ); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="as_ttl"><?php esc_attr_e( 'With these words in the title:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input type="text" id="as_ttl" name="as_ttl" placeholder="<?php esc_attr_e( 'ex: WordPress developer or receptionist', 'wp-indeed-jobs' ); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="as_cmp"><?php esc_attr_e( 'From this company:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input type="text" id="as_cmp" name="as_cmp" placeholder="<?php esc_attr_e( 'ex: WordPress developer or receptionist', 'wp-indeed-jobs' ); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="jt"><?php esc_attr_e( 'Show jobs of type:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <select id="jt" name="jt">
                    <option value="all"><?php esc_attr_e( 'All job types', 'wp-indeed-jobs' ); ?></option>
                    <option value="fulltime"><?php esc_attr_e( 'Full-time', 'wp-indeed-jobs' ); ?></option>
                    <option value="parttime"><?php esc_attr_e( 'Part-time', 'wp-indeed-jobs' ); ?></option>
                    <option value="contract"><?php esc_attr_e( 'Contract', 'wp-indeed-jobs' ); ?></option>
                    <option value="internship"><?php esc_attr_e( 'Internship', 'wp-indeed-jobs' ); ?></option>
                    <option value="temporary"><?php esc_attr_e( 'Temporary', 'wp-indeed-jobs' ); ?></option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="st"><?php esc_attr_e( 'Show jobs from:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <select id="st" name="st">
                    <option value=""><?php esc_attr_e( 'All web sites', 'wp-indeed-jobs' ); ?></option>
                    <option value="jobsite"><?php esc_attr_e( 'Job boards only', 'wp-indeed-jobs' ); ?></option>
                    <option value="employer"><?php esc_attr_e( 'Employer web sites only', 'wp-indeed-jobs' ); ?></option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label class="checkbox" for="sr">
                    <input id="sr" type="checkbox" name="sr" value="directhire"> <?php esc_attr_e( 'Exclude staffing agencies', 'wp-indeed-jobs' ); ?>
                </label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="salary"><?php esc_attr_e( 'Salary:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input type="text" id="salary" name="salary" placeholder="<?php esc_attr_e( 'ex: $50,000 or $40K-$90K', 'wp-indeed-jobs' ); ?>">
                <span class="help-inline"><?php esc_attr_e( 'per year', 'wp-indeed-jobs' ); ?></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="co"><?php esc_attr_e( 'Country', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <select id="co" name="co">
                    <option value="us"><?php  esc_attr_e( 'United States', 'wp-indeed-jobs' );   ?></option>
                    <option value="ar"><?php  esc_attr_e( 'Argentina', 'wp-indeed-jobs' );   ?></option>
                    <option value="au"><?php  esc_attr_e( 'Australia', 'wp-indeed-jobs' );   ?></option>
                    <option value="at"><?php  esc_attr_e( 'Austria', 'wp-indeed-jobs' );   ?></option>
                    <option value="bh"><?php  esc_attr_e( 'Bahrain', 'wp-indeed-jobs' );   ?></option>
                    <option value="be"><?php  esc_attr_e( 'Belgium', 'wp-indeed-jobs' );   ?></option>
                    <option value="br"><?php  esc_attr_e( 'Brazil', 'wp-indeed-jobs' );   ?></option>
                    <option value="CA"><?php  esc_attr_e( 'Canada', 'wp-indeed-jobs' );   ?></option>
                    <option value="cl"><?php  esc_attr_e( 'Chile', 'wp-indeed-jobs' );   ?></option>
                    <option value="cn"><?php  esc_attr_e( 'China', 'wp-indeed-jobs' );   ?></option>
                    <option value="co"><?php  esc_attr_e( 'Colombia', 'wp-indeed-jobs' );   ?></option>
                    <option value="cz"><?php  esc_attr_e( 'Czech Republic', 'wp-indeed-jobs' );   ?></option>
                    <option value="dk"><?php  esc_attr_e( 'Denmark', 'wp-indeed-jobs' );   ?></option>
                    <option value="fi"><?php  esc_attr_e( 'Finland', 'wp-indeed-jobs' );   ?></option>
                    <option value="fr"><?php  esc_attr_e( 'France', 'wp-indeed-jobs' );   ?></option>
                    <option value="de"><?php  esc_attr_e( 'Germany', 'wp-indeed-jobs' );   ?></option>
                    <option value="gr"><?php  esc_attr_e( 'Greece', 'wp-indeed-jobs' );   ?></option>
                    <option value="hk"><?php  esc_attr_e( 'Hong Kong', 'wp-indeed-jobs' );   ?></option>
                    <option value="hu"><?php  esc_attr_e( 'Hungary', 'wp-indeed-jobs' );   ?></option>
                    <option value="in"><?php  esc_attr_e( 'India', 'wp-indeed-jobs' );   ?></option>
                    <option value="id"><?php  esc_attr_e( 'Indonesia', 'wp-indeed-jobs' );   ?></option>
                    <option value="ie"><?php  esc_attr_e( 'Ireland', 'wp-indeed-jobs' );   ?></option>
                    <option value="il"><?php  esc_attr_e( 'Israel', 'wp-indeed-jobs' );   ?></option>
                    <option value="it"><?php  esc_attr_e( 'Italy', 'wp-indeed-jobs' );   ?></option>
                    <option value="jp"><?php  esc_attr_e( 'Japan', 'wp-indeed-jobs' );   ?></option>
                    <option value="kr"><?php  esc_attr_e( 'Korea', 'wp-indeed-jobs' );   ?></option>
                    <option value="kw"><?php  esc_attr_e( 'Kuwait', 'wp-indeed-jobs' );   ?></option>
                    <option value="lu"><?php  esc_attr_e( 'Luxembourg', 'wp-indeed-jobs' );   ?></option>
                    <option value="my"><?php  esc_attr_e( 'Malaysia', 'wp-indeed-jobs' );   ?></option>
                    <option value="mx"><?php  esc_attr_e( 'Mexico', 'wp-indeed-jobs' );   ?></option>
                    <option value="nl"><?php  esc_attr_e( 'Netherlands', 'wp-indeed-jobs' );   ?></option>
                    <option value="nz"><?php  esc_attr_e( 'New Zealand', 'wp-indeed-jobs' );   ?></option>
                    <option value="no"><?php  esc_attr_e( 'Norway', 'wp-indeed-jobs' );   ?></option>
                    <option value="om"><?php  esc_attr_e( 'Oman', 'wp-indeed-jobs' );   ?></option>
                    <option value="pk"><?php  esc_attr_e( 'Pakistan', 'wp-indeed-jobs' );   ?></option>
                    <option value="pe"><?php  esc_attr_e( 'Peru', 'wp-indeed-jobs' );   ?></option>
                    <option value="ph"><?php  esc_attr_e( 'Philippines', 'wp-indeed-jobs' );   ?></option>
                    <option value="pl"><?php  esc_attr_e( 'Poland', 'wp-indeed-jobs' );   ?></option>
                    <option value="pt"><?php  esc_attr_e( 'Portugal', 'wp-indeed-jobs' );   ?></option>
                    <option value="qa"><?php  esc_attr_e( 'Qatar', 'wp-indeed-jobs' );   ?></option>
                    <option value="ro"><?php  esc_attr_e( 'Romania', 'wp-indeed-jobs' );   ?></option>
                    <option value="ru"><?php  esc_attr_e( 'Russia', 'wp-indeed-jobs' );   ?></option>
                    <option value="sa"><?php  esc_attr_e( 'Saudi Arabia', 'wp-indeed-jobs' );   ?></option>
                    <option value="sg"><?php  esc_attr_e( 'Singapore', 'wp-indeed-jobs' );   ?></option>
                    <option value="za"><?php  esc_attr_e( 'South Africa', 'wp-indeed-jobs' );   ?></option>
                    <option value="es"><?php  esc_attr_e( 'Spain', 'wp-indeed-jobs' );   ?></option>
                    <option value="se"><?php  esc_attr_e( 'Sweden', 'wp-indeed-jobs' );   ?></option>
                    <option value="ch"><?php  esc_attr_e( 'Switzerland', 'wp-indeed-jobs' );   ?></option>
                    <option value="tw"><?php  esc_attr_e( 'Taiwan', 'wp-indeed-jobs' );   ?></option>
                    <option value="tr"><?php  esc_attr_e( 'Turkey', 'wp-indeed-jobs' );   ?></option>
                    <option value="ae"><?php  esc_attr_e( 'United Arab Emirates', 'wp-indeed-jobs' );   ?></option>
                    <option value="gb"><?php  esc_attr_e( 'United Kingdom', 'wp-indeed-jobs' );    ?></option>
                    <option value="ve"><?php  esc_attr_e( 'Venezuela', 'wp-indeed-jobs' );   ?></option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="radius"><?php esc_attr_e( 'Radius', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <select id="radius" name="radius">
                    <option value="0"><?php esc_attr_e( 'Only in', 'wp-indeed-jobs' ); ?></option>
                    <option value="5"><?php esc_attr_e( 'Within 5 miles of', 'wp-indeed-jobs' ); ?></option>
                    <option value="10"><?php esc_attr_e( 'Within 10 miles of', 'wp-indeed-jobs' ); ?></option>
                    <option value="15"><?php esc_attr_e( 'Within 15 miles of', 'wp-indeed-jobs' ); ?></option>
                    <option value="25"><?php esc_attr_e( 'Within 25 miles of', 'wp-indeed-jobs' ); ?></option>
                    <option value="50"><?php esc_attr_e( 'Within 50 miles of', 'wp-indeed-jobs' ); ?></option>
                    <option value="100"><?php esc_attr_e( 'Within 100 miles of', 'wp-indeed-jobs' ); ?></option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="where"><?php esc_attr_e( 'Location:', 'wp-indeed-jobs' ); ?></label>

            <div class="controls">
                <input id="where" type="text" name="l" size="28" maxlength="250" value="" autocomplete="off" placeholder="<?php esc_attr_e( 'ex: New York or MA', 'wp-indeed-jobs' ); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fromage"><?php esc_attr_e( 'Age - Jobs published', 'wp-indeed-jobs' ); ?> </label>

            <div class="controls">
                <select id="fromage" name="fromage">
                    <option value="any"><?php esc_attr_e( 'anytime', 'wp-indeed-jobs' ); ?></option>
                    <option value="15"><?php esc_attr_e( 'within 15 days', 'wp-indeed-jobs' ); ?></option>
                    <option value="7"><?php esc_attr_e( 'within 7 days', 'wp-indeed-jobs' ); ?></option>
                    <option value="3"><?php esc_attr_e( 'within 3 days', 'wp-indeed-jobs' ); ?></option>
                    <option value="1"><?php esc_attr_e( 'since yesterday', 'wp-indeed-jobs' ); ?></option>
                    <option value="last"><?php esc_attr_e( 'since my last visit', 'wp-indeed-jobs' ); ?></option>
                </select>
            </div>
        </div>
        <div>
            <input type="hidden" name="indeed-nonce" value="<?php echo wp_create_nonce( 'indeed-search-nonce' ); ?>" />
            <input type="hidden" name="publisher" id="" value="<?php echo esc_attr( $options['publisher_id'] ); ?>" />
            <input type="hidden" name="userip" id="userip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
            <input type="hidden" name="useragent" id="useragent" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>" />
            <input type="hidden" name="format" id="format" value="json" />
            <input type="hidden" name="limit" id="limit" value="<?php echo $options['limit']; ?>" />
            <input type="hidden" name="v" id="v" value="2" />
            <input type="hidden" name="action" value="search-indeed-jobs">

            <div class="form-actions">
                <button type="submit" class="btn btn-large btn-block btn-primary"><?php esc_attr_e( 'Find jobs', 'wp-indeed-jobs' ); ?></button>
            </div>
        </div>
    </fieldset>
</form>
                <!-- footer begin -->
                <footer>
                    <div class="container">
                        <div class="row">
                            <!--site desc-->

                            @if(!empty($widget_add['add_site_desc_footer']))
                                @include('layoutsFe.'.$widget_add['add_site_desc_footer'])
                            @endif
                            
                            <!--news footer-->
                            @if(!empty($widget_add['add_latest_news_footer']))
                                @include('layoutsFe.'.$widget_add['add_latest_news_footer'])
                            @endif
                            

                            <!--contact us footer-->
                            @if(!empty($widget_add['add_contact_us_footer']))
                                @include('layoutsFe.'.$widget_add['add_contact_us_footer'])
                            @endif
                            </div>
                    </div>

                    <div class="subfooter">
                        @if((!empty($widget_add['add_social'])) || (!empty($widget_add['add_text_footer'])))
                            @if(!empty($widget_add['add_social']))
                                @include('layoutsFe.'.$widget_add['add_social'])
                            @else
                                @include('layoutsFe.'.$widget_add['add_text_footer'])
                            @endif
                        @endif
                    </div>
    				<a href="#" id="back-to-top"></a>
                </footer>
                <!-- footer close -->

        

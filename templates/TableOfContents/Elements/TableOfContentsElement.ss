<% if $ElementsOnPage %>
    <div class="tableofcontents">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <% include ElementTitle %>
                    <div class="tableofcontents__content">
                        <% loop $ElementsOnPage %>
                            <div class="tableofcontents__item mb-2 mb-md-3">
                                <a href="$Link" class="tableofcontents__link text-decoration-none">
                                    $MenuTitle
                                </a>
                            </div>
                        <% end_loop %>
                    </div>
                </div>
            </div>
        </div>
    </div>
<% end_if %>

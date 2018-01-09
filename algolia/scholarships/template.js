var template = '<div class="item scholarship js-target">\
                  <h4 class="title js-toggle">\
                    {{name}}\
                    {{#avg}}<span class="amount">${{avg}}</span>{{/avg}}\
                                <svg aria-hidden="true" class="icon-plus-minus" width="29" height="29" viewBox="0 0 29 29" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><ellipse class="circle" cx="14.5" cy="14.5" rx="14.5" ry="14.5"></ellipse><path class="plus" d="M8.833 13.171h4.037V9.135h3.035v4.036h4.036v3.035h-4.036v4.036H12.87v-4.036H8.833z"></path><path class="minus" d="M8.833 13.171h11.108v3.035H8.833z"></path></g></svg>\
                  </h4>\
                  <div class="content">\
                    {{#requirements}}<p>{{requirements}}</p>{{/requirements}}\
                                {{#contact.address_1}}\
                                <h5>Address &amp; College Info</h5>\
                                <p>\
                                  {{contact.address_1}}<br />\
                                  {{#contact.city}}{{contact.city}},{{/contact.city}}\
                                  {{#contact.state}} {{contact.state}}{{/contact.state}}\
                                  {{#contact.zip}} {{contact.zip}}<br />{{/contact.zip}}\
                                  {{#contact.email}}{{contact.email}}<br />{{/contact.email}}\
                                  {{#contact.phone}}{{contact.phone}}{{/contact.phone}}\
                                </p>\
                                {{/contact.address_1}}\
                                {{#application_url}}<a class="link-tertiary" href="{{application_url}}" target="_blank" rel="nofollow" >Scholarship Application</a>{{/application_url}}\
                  </div>\
                </div>';
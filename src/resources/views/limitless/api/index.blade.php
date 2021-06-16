<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
      <!-- Mobile Specific -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Pixxett - API Docs Premium Template</title>
      <base href="{{ url('template/pixxett-api') }}/">
	  <link rel="icon" href="images/favicon.png" type="image/x-icon" />
      <meta name="description" content="Pixxett API Docs Theme">
      <meta name="author" content="Pixxett">
      <meta name="copyright" content="Pixxett">
      <meta name="date" content="2017-12-28">
      <!-- Google Fonts -->
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900">
      <!-- CSS Style -->
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="css/jquery.mobile-menu.css">
      <link rel="stylesheet" type="text/css" href="css/style.css" media="all">
      <link rel="stylesheet" type="text/css" href="css/responsive.css">
   </head>
   <body id="pixxett-api">
      <div id="page">
         <!-- Header -->
         <header class="header" id="header">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-1 col-sm-2">
                     <div class="mm-toggle-wrap">
                        <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
                     </div>
                     <!-- Header Logo -->
                     <a class="header__block header__brand" href="#">
                        <h1> <img src="images/logo.png" alt="API UI logo"></h1>
                     </a>
                     <!-- End Header Logo -->
                  </div>
                  <div class="col-lg-11 col-sm-10 hidden-xs">
                     <div class="header__nav">
                        <div class="header__nav--left">
                           <ul class="dx-nav-0 dx-nav-0-docs">
                              <li class="dx-nav-0-item ">
                                 <a class="dx-nav-0-link" href="javascript:void(0);">Docs</a>
                              </li>
                              <li class="dx-nav-0-item dx-nav-active">
                                 <a class="dx-nav-0-link" href="javascript:void(0);">API Reference</a>
                              </li>
                              <li class="dx-nav-0-item ">
                                 <a class="dx-nav-0-link" href="javascript:void(0);">Support</a>
                              </li>
                           </ul>
                           <form class="header__search dx-form-search" id="siteSearch" name="search" method="get">
                              <label class="sr-only" for="siteQ">Enter search term</label>
                              <input class="dx-search-input" id="siteQ" name="q" type="search" value="" placeholder="Search">
                              <span class="button-search fa fa-search"></span>
                           </form>
                        </div>
                        <div class="header__nav--right">
                           <ul class="dx-nav-0 dx-nav-0-tools">
                              <li class="dx-nav-0-item ">
                                 <a class="dx-nav-0-link" href="javascript:void(0);">Dashboard</a>
                              </li>
                              <li class="dx-nav-0-item ">
                                 <a class="dx-nav-0-link" href="javascript:void(0);">Demo</a>
                              </li>
                              <li class="dx-nav-0-item ">
                                 <a class="dx-nav-0-link" href="javascript:void(0);">Pricing</a>
                              </li>
                              <li class="dx-nav-0-item ">
                                 <a class="dx-nav-0-link" href="javascript:void(0);">Contact Us</a>
                              </li>
                           </ul>
                           <div class="dx-auth-block">
                              <div class="dx-auth-logged-out">
                                 <a class="dx-auth-login dx-btn dx-btn-primary" data-js="auth-btn" href="javascript:void(0);"
                                    data-dxa="login,nav-click,nav-login">Log In</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <!-- end header -->
         <!-- header service -->
         <div class="header-section-wrapper">
            <div class="header-section header-section-example">
               <div id="language">
                  <ul class="language-toggle">
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-curl" data-language="curl" checked="checked">
                        <label for="toggle-lang-curl" class="language-toggle-button language-toggle-button--curl">curl</label>
                     </li>
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-ruby" data-language="ruby">
                        <label for="toggle-lang-ruby" class="language-toggle-button language-toggle-button--ruby">Ruby</label>
                     </li>
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-python" data-language="python">
                        <label for="toggle-lang-python" class="language-toggle-button language-toggle-button--python">Python</label>
                     </li>
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-php" data-language="php">
                        <label for="toggle-lang-php" class="language-toggle-button language-toggle-button--php">PHP</label>
                     </li>
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-java" data-language="java">
                        <label for="toggle-lang-java" class="language-toggle-button language-toggle-button--java">Java</label>
                     </li>
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-node" data-language="node">
                        <label for="toggle-lang-node" class="language-toggle-button language-toggle-button--node">Node</label>
                     </li>
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-go" data-language="go">
                        <label for="toggle-lang-go" class="language-toggle-button language-toggle-button--go">Go</label>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- End header service -->
         <!-- Sidebar -->
         <div id="documenter_sidebar">
            <div id="scrollholder" class="scrollholder">
               <div id="scroll" class="scroll">
                  <ol id="documenter_nav">
                     <li><a class="current" href="#documenter-1"><i class="fa fa-file-text-o"></i> API Reference</a></li>
                     <li><a href="#documenter-2"><i class="fa fa-key"></i> Authentication </a>
                     </li>
                     <li>
                        <a href="#documenter-3"><i class="fa fa-warning"></i> Errors </a>
                        <ol>
                           <li><a href="#documenter-3-1">Handling errors</a></li>
                        </ol>
                     </li>
                     <li>
                        <a href="#documenter-4"><i class="fa fa-table"></i> Tables</a>
                        <ol>
                           <li><a href="#documenter-4-1">Default Talbe</a></li>
                           <li><a href="#documenter-4-2">Exampled Rows</a> </li>
                           <li><a href="#documenter-4-3">Bordered Table</a> </li>
                           <li><a href="#documenter-4-4">Contextual Classes</a> </li>
                        </ol>
                     </li>
                     <li>
                        <a href="#documenter-5"><i class="fa fa-gear"></i> General</a>
                        <ol>
                           <li><a href="#documenter-5-1">Headings</a> </li>
                           <li><a href="#documenter-5-2">Paragraph</a> </li>
                           <li><a href="#documenter-5-3">Inline Text Elements</a> </li>
                           <li><a href="#documenter-5-4">Alignment and Transformation</a> </li>
                           <li><a href="#documenter-5-5">Abbrevations</a> </li>
                           <li><a href="#documenter-5-6">Addresses</a> </li>
                           <li><a href="#documenter-5-7">Unordered and Ordered List</a> </li>
                           <li><a href="#documenter-5-8">Unstyled and Inline list</a></li>
                           <li><a href="#documenter-5-9">Blockquotes</a> </li>
                           <li><a href="#documenter-5-10">Descriptions</a> </li>
                        </ol>
                     </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- end sidebar -->
         <!-- Section Background -->
         <div id="background">
            <div class="background-actual"></div>
         </div>
         <!-- End Section Background -->
         <!-- main Content -->
         <div id="documenter_content" class="method-area-wrapper">
            <section id="documenter-1" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>API Reference</h3>
                        <p>
                           Lorem ipsum dolor sit amet, consectetur <a href="#">ELIT</a>. Nam in nisi 
                           eros. Proin quis ultricies neque. Proin imperdiet leo a leo euismod 
                           ultrices. Cras et tempor elit. Duis aliquet volutpat sapien, eget porta tellus
                           laoreet in. Donec sem velit, tincidunt eu sodales vel, varius non libero.
                           Sed nisl mauris,<a href="#"> facilisis sit amet hendrerit at</a>, hendrerit
                           vel tortor. Aliquam id massa euismod, ultricies metus nec, convallis urna. In
                           laoreet dapibus ante vitae placerat. Pellentesque mollis nec sapien
                           elementum eu tincidunt. <a href="#">SAPIEN</a> elit placerat Phasellus laoreet vitae,
                           Cras in massa ac mi sodales <a href="#">Ligula Fermentum</a> vestibulum
                           et rutrum odio tincidunt. Nunc id maximus orci.
                        </p>
                        <p>
                           Vestibulum mollis eros nunc, pretium porta dolor gravida vel. Nullam arcu diam, 
                           semper a varius sit amet, interdum vel enim. Duis orci nunc, eleifend vel tellus
                           ut, finibus fermentum erat. Curabitur sagittis justo augue. Phasellus fermentum
                           semper nisi, in consequat lectus tincidunt quis. Maecenas sit amet semper. 
                        </p>
                        <p> <img src="images/place-holder.png" alt="Image"> </p>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>API Reference</h5>
                        <p>
                           Curabitur lacinia convallis nibh, <a href="#">non cursus augue</a>. Quisque id
                           sem id lorem porttitor efficitur in quis libero. Nullam turpis ante auctor <a href="#">purus sed</a>.
                        </p>
                     </div>
                     <div class="method-example-part">
                        <div class="method-example-endpoint">
                           <pre class=" language-none"><code class=" language-none">https://examples.com</code></pre>
                        </div>
                     </div>
                  </div>
               </div>
            </section>            
            <section id="documenter-2" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3> Authentication </h3>
                        <p>
                           In laoreet dapibus ante vitae placerat. Pellentesque mollis 
                           sapien nec sapien elementum, eu tincidunt elit placerat.
                           Phasellus <code class=" language-undefined">2xx</code> laoreet vitae mi at hendrerit. Cras in jni
                           <code class=" language-undefined">4xx</code> lectus vitae ligula fermentum, et rutrum odio
                           sit amet, interdum vel enim. Duis orci nunc, eleifend
                           vel tellus ut, finibus fermentum erat. Curabitur <code class=" language-undefined">5xx</code>
                           in consequat lectus tincidunt quis. Maecenas sit amet semper nisl.
                        </p>
                        <p>
                           In laoreet dapibus ante vitae placerat. Pellentesque
                           mollis sapien nec sapien elementum, eu tincidunt elit 
                           placerat. Phasellus laoreet vitae mi at hendrerit. Cras 
                           in massa ac mi sodales vestibulum. Etiam convallis lectus 
                           vitae <a href="#"> ligula fermentum</a>
                           maximus orci.
                        </p>
                     </div>
                     <div class="method-list attributes">
                        <h5 class="method-list-title"> Attributes </h5>
                        <ul class="method-list-group">
                           <li class="method-list-item">
                              <h6 class="method-list-item-label"><a href="#" class="header-anchor"></a>
                                 type
                              </h6>
                              <p class="method-list-item-description">
                                 The type of error returned. Can be: <code class=" language-undefined">api_connection_error</code>, <code class=" language-undefined">api_error</code>, <code class=" language-undefined">authentication_error</code>, <code class=" language-undefined">card_error</code>, <code class=" language-undefined">invalid_request_error</code>, or <code class=" language-undefined">rate_limit_error</code>.
                              </p>
                           </li>
                           <li class="method-list-item">
                              <h6 class="method-list-item-label"><a href="#" class="header-anchor"></a>
                                 charge
                              </h6>
                              <p class="method-list-item-description">
                                  Nunc suscipit justo ac odio.
                              </p>
                           </li>
                           <li class="method-list-item">
                              <h6 class="method-list-item-label"><a href="#" class="header-anchor"></a>
                                 message
                                 <span class="method-list-item-label-details">optional</span>
                              </h6>
                              <p class="method-list-item-description">
                                  Nunc suscipit justo ac odio condimentum malesuada Nunc suscipit justo ac odio
                                              condimentum malesuada Nunc suscipit justo ac odio.
                              </p>
                           </li>
                           <li class="method-list-item">
                              <h6 class="method-list-item-label"><a href="#" class="header-anchor"></a>
                                 code
                                 <span class="method-list-item-label-details">optional</span>
                              </h6>
                              <p class="method-list-item-description">
                                 Nunc suscipit justo ac odio condimentum malesuada Nunc suscipit justo ac odio
                                              condimentum malesuada Nunc suscipit justo ac odio.
                              </p>
                           </li>
                           <li class="method-list-item">
                              <h6 class="method-list-item-label"><a href="#" class="header-anchor"></a>
                                 decline_code
                                 <span class="method-list-item-label-details">optional</span>
                              </h6>
                              <p class="method-list-item-description">
                                 Nunc suscipit justo ac odio condimentum malesuada Nunc suscipit justo ac odio
                                              <a href="#">condimentum malesuada Nunc </a>
                                              suscipit justo ac odio.
                              </p>
                           </li>
                           <li class="method-list-item">
                              <h6 class="method-list-item-label"><a href="#" class="header-anchor"></a>
                                 param
                                 <span class="method-list-item-label-details">optional</span>
                              </h6>
                              <p class="method-list-item-description">
                                 Nunc suscipit justo ac odio condimentum malesuada Nunc suscipit justo.
                                              ac odio Nunc suscipit justo ac odio condimentum malesuada Nunc suscipit
                                              justo.
                              </p>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5> Authentication </h5>
                        <div class="table-responsive">
                           <div class="table">
                              <table class="table-container">
                                 <colgroup>
                                    <col class="col-xs-3">
                                    <col class="col-xs-9">
                                 </colgroup>
                                 <tbody>
                                    <tr>
                                       <th class="table-row-property">200 - OK</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">400 - Bad Request</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">401 - Unauthorized</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">402 - Request Failed</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">404 - Not Found</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">409 - Conflict</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien (mollis sapien nec sapien).</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">429 - Too Many Requests</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">500, 502, 503, 504 - Server Errors</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="method-example-part">
                        <h5>Errors</h5>
                        <div class="table-responsive">
                           <div class="table">
                              <header class="table-header">
                                 Types
                              </header>
                              <table class="table-container">
                                 <colgroup>
                                    <col class="col-xs-3">
                                    <col class="col-xs-9">
                                 </colgroup>
                                 <tbody>
                                    <tr>
                                       <th class="table-row-property">api_connection_error</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">api_error</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">authentication_error</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien Pellentesque mollis.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">card_error</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">invalid_request_error</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">rate_limit_error</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">validation_error</th>
                                       <td class="table-row-definition">Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien Pellentesque mollis sapien nec sapien (Pellentesque mollis).</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="table-responsive">
                           <div class="table">
                              <header class="table-header">
                                 Codes
                              </header>
                              <table class="table-container">
                                 <colgroup>
                                    <col class="col-xs-3">
                                    <col class="col-xs-9">
                                 </colgroup>
                                 <tbody>
                                    <tr>
                                       <th class="table-row-property">invalid_number</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">invalid_expiry_month</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">invalid_expiry_year</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">invalid_cvc</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">invalid_swipe_data</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">incorrect_number</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">expired_card</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">incorrect_cvc</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">incorrect_zip</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">card_declined</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">missing</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                    <tr>
                                       <th class="table-row-property">processing_error</th>
                                       <td class="table-row-definition">Curabitur lacinia convallis nibh, non cursus augue.</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <footer class="table-footer">
                                 Curabitur lacinia convallis nibh, non cursus augue
                                 <a href="#">convallis</a>.
                              </footer>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-3" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3 id="handling-errors">Errors</h3>
                        <p>
                           In laoreet dapibus ante vitae placerat. Pellentesque, 
                           mollis sapien nec sapien elementum, eu tincidunt elit placerat. Phasellus,
                           laoreet vitae mi at hendrerit. Cras in massa ac mi sodales vestibulum. Etiam convallis lectus vitae ligula.
                        </p>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="code-curl code-div active-code">
                        <div class="method-example-part">
                           <pre class=" language-ruby">No data</pre>
                        </div>
                     </div>
                     <div class="code-ruby code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class="language-ruby"><code class="language-ruby"><span class="token keyword">begin</span>
                            <span class="token comment" spellcheck="true"># Use example's library to make requests...</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:CardError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Since it's a decline, example::CardError will be caught</span>
                            body <span class="token operator">=</span> e<span class="token punctuation">.</span>json_body
                            err  <span class="token operator">=</span> body<span class="token punctuation">[</span><span class="token symbol">:error</span><span class="token punctuation">]</span>

                            puts <span class="token string">"Status is: <span class="token interpolation"><span class="token delimiter tag">#{</span>e<span class="token punctuation">.</span>http_status<span class="token delimiter tag">}</span></span>"</span>
                            puts <span class="token string">"Type is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>type<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span>
                            puts <span class="token string">"Charge ID is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>charge<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span>
                            <span class="token comment" spellcheck="true"># The following fields are optional</span>
                            puts <span class="token string">"Code is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>code<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:code</span><span class="token punctuation">]</span>
                            puts <span class="token string">"Decline code is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>decline_code<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:decline_code</span><span class="token punctuation">]</span>
                            puts <span class="token string">"Param is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>param<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:param</span><span class="token punctuation">]</span>
                            puts <span class="token string">"Message is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>message<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:message</span><span class="token punctuation">]</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:RateLimitError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Too many requests made to the API too quickly</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:InvalidRequestError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Invalid parameters were supplied to example's API</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:AuthenticationError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true"># (maybe you changed API keys recently)</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:APIConnectionError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Network communication with example failed</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:exampleError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true"># yourself an email</span>
                            <span class="token keyword">rescue</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Something else happened, completely unrelated to example</span>
                            <span class="token keyword">end</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-python code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-python"><code class=" language-python"><span class="token keyword">try</span><span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Use example's library to make requests...</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>CardError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Since it's a decline, example.error.CardError will be caught</span>
                            body <span class="token operator">=</span> e<span class="token punctuation">.</span>json_body
                            err  <span class="token operator">=</span> body<span class="token punctuation">[</span><span class="token string">'error'</span><span class="token punctuation">]</span>

                            <span class="token keyword">print</span> <span class="token string">"Status is: %s"</span> <span class="token operator">%</span> e<span class="token punctuation">.</span>http_status
                            <span class="token keyword">print</span> <span class="token string">"Type is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'type'</span><span class="token punctuation">]</span>
                            <span class="token keyword">print</span> <span class="token string">"Code is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'code'</span><span class="token punctuation">]</span>
                            <span class="token comment" spellcheck="true"># param is '' in this case</span>
                            <span class="token keyword">print</span> <span class="token string">"Param is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'param'</span><span class="token punctuation">]</span>
                            <span class="token keyword">print</span> <span class="token string">"Message is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'message'</span><span class="token punctuation">]</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>RateLimitError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Too many requests made to the API too quickly</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>InvalidRequestError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Invalid parameters were supplied to example's API</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>AuthenticationError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true"># (maybe you changed API keys recently)</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>APIConnectionError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Network communication with example failed</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>exampleError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true"># yourself an email</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> Exception <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Something else happened, completely unrelated to example</span>
                            <span class="token keyword">pass</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-php code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-php"><code class=" language-php"><span class="token keyword">try</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Use example's library to make requests...</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span><span class="token punctuation">(</span>\<span class="token package">example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>Card</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Since it's a decline, \example\Error\Card will be caught</span>
                            <span class="token variable">$body</span> <span class="token operator">=</span> <span class="token variable">$e</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getJsonBody</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token variable">$err</span>  <span class="token operator">=</span> <span class="token variable">$body</span><span class="token punctuation">[</span><span class="token string">'error'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Status is:'</span> <span class="token punctuation">.</span> <span class="token variable">$e</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getHttpStatus</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Type is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'type'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Code is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'code'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token comment" spellcheck="true">// param is '' in this case</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Param is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'param'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Message is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'message'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>RateLimit</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Too many requests made to the API too quickly</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>InvalidRequest</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Invalid parameters were supplied to example's API</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>Authentication</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true">// (maybe you changed API keys recently)</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>ApiConnection</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Network communication with example failed</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>Base</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true">// yourself an email</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">Exception</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Something else happened, completely unrelated to example</span>
                            <span class="token punctuation">}</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-java code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-java"><code class=" language-java"><span class="token keyword">try</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Use example's library to make requests...</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">CardException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Since it's a decline, CardException will be caught</span>
                            System<span class="token punctuation">.</span>out<span class="token punctuation">.</span><span class="token function">println</span><span class="token punctuation">(</span><span class="token string">"Status is: "</span> <span class="token operator">+</span> e<span class="token punctuation">.</span><span class="token function">getCode</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            System<span class="token punctuation">.</span>out<span class="token punctuation">.</span><span class="token function">println</span><span class="token punctuation">(</span><span class="token string">"Message is: "</span> <span class="token operator">+</span> e<span class="token punctuation">.</span><span class="token function">getMessage</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">RateLimitException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Too many requests made to the API too quickly</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">InvalidRequestException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Invalid parameters were supplied to example's API</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">AuthenticationException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true">// (maybe you changed API keys recently)</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">APIConnectionException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Network communication with example failed</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">exampleException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true">// yourself an email</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">Exception</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Something else happened, completely unrelated to example</span>
                            <span class="token punctuation">}</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-node code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-javascript"><code class=" language-javascript"><span class="token comment" spellcheck="true">// Note: Node.js API does not throw exceptions, and instead prefers the</span>
                                <span class="token comment" spellcheck="true">// asynchronous style of error handling described below.</span>
                                <span class="token comment" spellcheck="true">//</span>
                                <span class="token comment" spellcheck="true">// An error from the example API or an otheriwse asynchronous error</span>
                                <span class="token comment" spellcheck="true">// will be available as the first argument of any example method's callback:</span>
                                <span class="token comment" spellcheck="true">// E.g. example.customers.create({...}, function(err, result) {});</span>
                                <span class="token comment" spellcheck="true">//</span>
                                <span class="token comment" spellcheck="true">// Or in the form of a rejected promise.</span>
                                <span class="token comment" spellcheck="true">// E.g. example.customers.create({...}).then(</span>
                                <span class="token comment" spellcheck="true">//        function(result) {},</span>
                                <span class="token comment" spellcheck="true">//        function(err) {}</span>
                                <span class="token comment" spellcheck="true">//      );</span>

                                <span class="token keyword">switch</span> <span class="token punctuation">(</span>err<span class="token punctuation">.</span>type<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleCardError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// A declined card error</span>
                                err<span class="token punctuation">.</span>message<span class="token punctuation">;</span> <span class="token comment" spellcheck="true">// =&gt; e.g. "Your card's expiration year is invalid."</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'RateLimitError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Too many requests made to the API too quickly</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleInvalidRequestError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Invalid parameters were supplied to example's API</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleAPIError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// An error occurred internally with example's API</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleConnectionError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Some kind of error occurred during the HTTPS communication</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleAuthenticationError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// You probably used an incorrect API key</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">default</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Handle any other types of unexpected errors</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token punctuation">}</span></code>
                            </pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-go code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-go"><code class=" language-go"><span class="token boolean">_</span><span class="token punctuation">,</span> err <span class="token operator">:=</span> <span class="token comment" spellcheck="true">// Go library call</span>

                            <span class="token keyword">if</span> err <span class="token operator">!=</span> <span class="token boolean">nil</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Try to safely cast a generic error to a example.Error so that we can get at</span>
                            <span class="token comment" spellcheck="true">// some additional example-specific information about what went wrong.</span>
                            <span class="token keyword">if</span> exampleErr<span class="token punctuation">,</span> ok <span class="token operator">:=</span> err<span class="token punctuation">.</span><span class="token punctuation">(</span><span class="token operator">*</span>example<span class="token punctuation">.</span>Error<span class="token punctuation">)</span><span class="token punctuation">;</span> ok <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// The Code field will contain a basic identifier for the failure.</span>
                            <span class="token keyword">switch</span> exampleErr<span class="token punctuation">.</span>Code <span class="token punctuation">{</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>IncorrectNum<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidNum<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidExpM<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidExpY<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidCvc<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>ExpiredCard<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>IncorrectCvc<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>IncorrectZip<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>CardDeclined<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>Missing<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>ProcessingErr<span class="token punctuation">:</span>
                            <span class="token punctuation">}</span>

                            <span class="token comment" spellcheck="true">// The Err field can be coerced to a more specific error type with a type</span>
                            <span class="token comment" spellcheck="true">// assertion. This technique can be used to get more specialized</span>
                            <span class="token comment" spellcheck="true">// information for certain errors.</span>
                            <span class="token keyword">if</span> cardErr<span class="token punctuation">,</span> ok <span class="token operator">:=</span> exampleErr<span class="token punctuation">.</span>Err<span class="token punctuation">.</span><span class="token punctuation">(</span><span class="token operator">*</span>example<span class="token punctuation">.</span>CardError<span class="token punctuation">)</span><span class="token punctuation">;</span> ok <span class="token punctuation">{</span>
                            fmt<span class="token punctuation">.</span><span class="token function">Printf</span><span class="token punctuation">(</span><span class="token string">"Card was declined with code: %v\n"</span><span class="token punctuation">,</span> cardErr<span class="token punctuation">.</span>DeclineCode<span class="token punctuation">)</span>
                            <span class="token punctuation">}</span> <span class="token keyword">else</span> <span class="token punctuation">{</span>
                            fmt<span class="token punctuation">.</span><span class="token function">Printf</span><span class="token punctuation">(</span><span class="token string">"Other example error occurred: %v\n"</span><span class="token punctuation">,</span> exampleErr<span class="token punctuation">.</span><span class="token function">Error</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span>
                            <span class="token punctuation">}</span>
                            <span class="token punctuation">}</span> <span class="token keyword">else</span> <span class="token punctuation">{</span>
                            fmt<span class="token punctuation">.</span><span class="token function">Printf</span><span class="token punctuation">(</span><span class="token string">"Other error occurred: %v\n"</span><span class="token punctuation">,</span> err<span class="token punctuation">.</span><span class="token function">Error</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span>
                            <span class="token punctuation">}</span>
                            <span class="token punctuation">}</span></code></pre>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-3-1" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Handling errors</h3>
                        <p>In laoreet dapibus ante vitae placerat. Pellentesque mollis sapien nec sapien <code>.table</code> elementum <code>&lt;table&gt;</code>. eu tincidunt elit placerat. Phasellus laoreet vitae mi at hendrerit. Cras in massa ac mi sodales vestibulum. Etiam convallis lectus vitae ligula fermentum, et rutrum odio tincidunt.</p>
                        <div class="table-responsive">
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <td class="text-center"><i class="fa fa-trash"></i></td>
                                    <td>ID</td>
                                    <td>Pretium</td>
                                    <td>bytes</td>
                                    <td>Duis</td>
                                    <td>Urna Neque</td>
                                    <td>Phasellus</td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla. Aliquam ligula quam, blandit sed neque vel, aliquet viverra eros.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox2" type="checkbox"><label for="checkbox2"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla. Aliquam ligula quam, blandit sed neque vel, aliquet viverra eros.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox3" type="checkbox"><label for="checkbox3"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla. Aliquam ligula quam, blandit sed neque vel, aliquet viverra eros.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox4" type="checkbox"><label for="checkbox4"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla. Aliquam ligula quam, blandit sed neque vel, aliquet viverra eros.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox5" type="checkbox"><label for="checkbox5"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla. Aliquam ligula quam, blandit sed neque vel, aliquet viverra eros.</td>
                                    <td>Credit Card</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Handling Errors</h5>
                        <div class="table">
                           <table class="table-container">
                              <colgroup>
                                 <col class="col-xs-3">
                                 <col class="col-xs-9">
                              </colgroup>
                              <tbody>
                                 <tr>
                                    <th class="table-row-property">200 - OK</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">400 - Bad Request</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus, Vivamus rhoncus dui vitae eros.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">401 - Unauthorized</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">402 - Request Failed</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">404 - Not Found</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">409 - Conflict</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (dui vitae eros tristique cursus).</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">429 - Too Many Requests</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus Vivamus rhoncus dui vitae eros tristique.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">500, 502, 503, 504 - Server Errors</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (Vivamus rhoncus)</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </section>			
			<section id="documenter-4" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3 id="handling-errors">Tables</h3>
                        <p>
                           In laoreet dapibus ante vitae placerat. Pellentesque,
                           mollis sapien nec sapien elementum, eu tincidunt elit placerat. Phasellus,
                           laoreet vitae mi at hendrerit. Cras in massa ac mi sodales vestibulum. Etiam convallis lectus vitae ligula.
                        </p>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="code-curl code-div active-code">
                        <div class="method-example-part">
                           <pre class=" language-ruby">No data</pre>
                        </div>
                     </div>
                     <div class="code-ruby code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class="language-ruby"><code class="language-ruby"><span class="token keyword">begin</span>
                            <span class="token comment" spellcheck="true"># Use example's library to make requests...</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:CardError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Since it's a decline, example::CardError will be caught</span>
                            body <span class="token operator">=</span> e<span class="token punctuation">.</span>json_body
                            err  <span class="token operator">=</span> body<span class="token punctuation">[</span><span class="token symbol">:error</span><span class="token punctuation">]</span>

                            puts <span class="token string">"Status is: <span class="token interpolation"><span class="token delimiter tag">#{</span>e<span class="token punctuation">.</span>http_status<span class="token delimiter tag">}</span></span>"</span>
                            puts <span class="token string">"Type is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>type<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span>
                            puts <span class="token string">"Charge ID is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>charge<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span>
                            <span class="token comment" spellcheck="true"># The following fields are optional</span>
                            puts <span class="token string">"Code is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>code<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:code</span><span class="token punctuation">]</span>
                            puts <span class="token string">"Decline code is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>decline_code<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:decline_code</span><span class="token punctuation">]</span>
                            puts <span class="token string">"Param is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>param<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:param</span><span class="token punctuation">]</span>
                            puts <span class="token string">"Message is: <span class="token interpolation"><span class="token delimiter tag">#{</span>err<span class="token punctuation">[</span><span class="token punctuation">:</span>message<span class="token punctuation">]</span><span class="token delimiter tag">}</span></span>"</span> <span class="token keyword">if</span> err<span class="token punctuation">[</span><span class="token symbol">:message</span><span class="token punctuation">]</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:RateLimitError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Too many requests made to the API too quickly</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:InvalidRequestError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Invalid parameters were supplied to example's API</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:AuthenticationError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true"># (maybe you changed API keys recently)</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:APIConnectionError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Network communication with example failed</span>
                            <span class="token keyword">rescue</span> <span class="token constant">example</span><span class="token punctuation">:</span><span class="token symbol">:exampleError</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true"># yourself an email</span>
                            <span class="token keyword">rescue</span> <span class="token operator">=</span><span class="token operator">&gt;</span> e
                            <span class="token comment" spellcheck="true"># Something else happened, completely unrelated to example</span>
                            <span class="token keyword">end</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-python code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-python"><code class=" language-python"><span class="token keyword">try</span><span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Use example's library to make requests...</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>CardError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Since it's a decline, example.error.CardError will be caught</span>
                            body <span class="token operator">=</span> e<span class="token punctuation">.</span>json_body
                            err  <span class="token operator">=</span> body<span class="token punctuation">[</span><span class="token string">'error'</span><span class="token punctuation">]</span>

                            <span class="token keyword">print</span> <span class="token string">"Status is: %s"</span> <span class="token operator">%</span> e<span class="token punctuation">.</span>http_status
                            <span class="token keyword">print</span> <span class="token string">"Type is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'type'</span><span class="token punctuation">]</span>
                            <span class="token keyword">print</span> <span class="token string">"Code is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'code'</span><span class="token punctuation">]</span>
                            <span class="token comment" spellcheck="true"># param is '' in this case</span>
                            <span class="token keyword">print</span> <span class="token string">"Param is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'param'</span><span class="token punctuation">]</span>
                            <span class="token keyword">print</span> <span class="token string">"Message is: %s"</span> <span class="token operator">%</span> err<span class="token punctuation">[</span><span class="token string">'message'</span><span class="token punctuation">]</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>RateLimitError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Too many requests made to the API too quickly</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>InvalidRequestError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Invalid parameters were supplied to example's API</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>AuthenticationError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true"># (maybe you changed API keys recently)</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>APIConnectionError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Network communication with example failed</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> example<span class="token punctuation">.</span>error<span class="token punctuation">.</span>exampleError <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true"># yourself an email</span>
                            <span class="token keyword">pass</span>
                            <span class="token keyword">except</span> Exception <span class="token keyword">as</span> e<span class="token punctuation">:</span>
                            <span class="token comment" spellcheck="true"># Something else happened, completely unrelated to example</span>
                            <span class="token keyword">pass</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-php code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-php"><code class=" language-php"><span class="token keyword">try</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Use example's library to make requests...</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span><span class="token punctuation">(</span>\<span class="token package">example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>Card</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Since it's a decline, \example\Error\Card will be caught</span>
                            <span class="token variable">$body</span> <span class="token operator">=</span> <span class="token variable">$e</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getJsonBody</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token variable">$err</span>  <span class="token operator">=</span> <span class="token variable">$body</span><span class="token punctuation">[</span><span class="token string">'error'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Status is:'</span> <span class="token punctuation">.</span> <span class="token variable">$e</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getHttpStatus</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Type is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'type'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Code is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'code'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token comment" spellcheck="true">// param is '' in this case</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Param is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'param'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token keyword">print</span><span class="token punctuation">(</span><span class="token string">'Message is:'</span> <span class="token punctuation">.</span> <span class="token variable">$err</span><span class="token punctuation">[</span><span class="token string">'message'</span><span class="token punctuation">]</span> <span class="token punctuation">.</span> <span class="token string">"\n"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>RateLimit</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Too many requests made to the API too quickly</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>InvalidRequest</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Invalid parameters were supplied to example's API</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>Authentication</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true">// (maybe you changed API keys recently)</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>ApiConnection</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Network communication with example failed</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name"><span class="token punctuation">\</span>example<span class="token punctuation">\</span>Error<span class="token punctuation">\</span>Base</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true">// yourself an email</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">Exception</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Something else happened, completely unrelated to example</span>
                            <span class="token punctuation">}</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-java code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-java"><code class=" language-java"><span class="token keyword">try</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Use example's library to make requests...</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">CardException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Since it's a decline, CardException will be caught</span>
                            System<span class="token punctuation">.</span>out<span class="token punctuation">.</span><span class="token function">println</span><span class="token punctuation">(</span><span class="token string">"Status is: "</span> <span class="token operator">+</span> e<span class="token punctuation">.</span><span class="token function">getCode</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            System<span class="token punctuation">.</span>out<span class="token punctuation">.</span><span class="token function">println</span><span class="token punctuation">(</span><span class="token string">"Message is: "</span> <span class="token operator">+</span> e<span class="token punctuation">.</span><span class="token function">getMessage</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">RateLimitException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Too many requests made to the API too quickly</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">InvalidRequestException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Invalid parameters were supplied to example's API</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">AuthenticationException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Authentication with example's API failed</span>
                            <span class="token comment" spellcheck="true">// (maybe you changed API keys recently)</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">APIConnectionException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Network communication with example failed</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">exampleException</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Display a very generic error to the user, and maybe send</span>
                            <span class="token comment" spellcheck="true">// yourself an email</span>
                            <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">Exception</span> e<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Something else happened, completely unrelated to example</span>
                            <span class="token punctuation">}</span></code></pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-node code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-javascript"><code class=" language-javascript"><span class="token comment" spellcheck="true">// Note: Node.js API does not throw exceptions, and instead prefers the</span>
                                <span class="token comment" spellcheck="true">// asynchronous style of error handling described below.</span>
                                <span class="token comment" spellcheck="true">//</span>
                                <span class="token comment" spellcheck="true">// An error from the example API or an otheriwse asynchronous error</span>
                                <span class="token comment" spellcheck="true">// will be available as the first argument of any example method's callback:</span>
                                <span class="token comment" spellcheck="true">// E.g. example.customers.create({...}, function(err, result) {});</span>
                                <span class="token comment" spellcheck="true">//</span>
                                <span class="token comment" spellcheck="true">// Or in the form of a rejected promise.</span>
                                <span class="token comment" spellcheck="true">// E.g. example.customers.create({...}).then(</span>
                                <span class="token comment" spellcheck="true">//        function(result) {},</span>
                                <span class="token comment" spellcheck="true">//        function(err) {}</span>
                                <span class="token comment" spellcheck="true">//      );</span>

                                <span class="token keyword">switch</span> <span class="token punctuation">(</span>err<span class="token punctuation">.</span>type<span class="token punctuation">)</span> <span class="token punctuation">{</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleCardError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// A declined card error</span>
                                err<span class="token punctuation">.</span>message<span class="token punctuation">;</span> <span class="token comment" spellcheck="true">// =&gt; e.g. "Your card's expiration year is invalid."</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'RateLimitError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Too many requests made to the API too quickly</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleInvalidRequestError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Invalid parameters were supplied to example's API</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleAPIError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// An error occurred internally with example's API</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleConnectionError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Some kind of error occurred during the HTTPS communication</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">case</span> <span class="token string">'exampleAuthenticationError'</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// You probably used an incorrect API key</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token keyword">default</span><span class="token punctuation">:</span>
                                <span class="token comment" spellcheck="true">// Handle any other types of unexpected errors</span>
                                <span class="token keyword">break</span><span class="token punctuation">;</span>
                                <span class="token punctuation">}</span></code>
                            </pre>
                           </div>
                        </div>
                     </div>
                     <div class="code-go code-div">
                        <div class="method-example-part">
                           <div class=" language-undefined">
                              <pre class=" language-go"><code class=" language-go"><span class="token boolean">_</span><span class="token punctuation">,</span> err <span class="token operator">:=</span> <span class="token comment" spellcheck="true">// Go library call</span>

                            <span class="token keyword">if</span> err <span class="token operator">!=</span> <span class="token boolean">nil</span> <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// Try to safely cast a generic error to a example.Error so that we can get at</span>
                            <span class="token comment" spellcheck="true">// some additional example-specific information about what went wrong.</span>
                            <span class="token keyword">if</span> exampleErr<span class="token punctuation">,</span> ok <span class="token operator">:=</span> err<span class="token punctuation">.</span><span class="token punctuation">(</span><span class="token operator">*</span>example<span class="token punctuation">.</span>Error<span class="token punctuation">)</span><span class="token punctuation">;</span> ok <span class="token punctuation">{</span>
                            <span class="token comment" spellcheck="true">// The Code field will contain a basic identifier for the failure.</span>
                            <span class="token keyword">switch</span> exampleErr<span class="token punctuation">.</span>Code <span class="token punctuation">{</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>IncorrectNum<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidNum<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidExpM<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidExpY<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>InvalidCvc<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>ExpiredCard<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>IncorrectCvc<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>IncorrectZip<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>CardDeclined<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>Missing<span class="token punctuation">:</span>
                            <span class="token keyword">case</span> example<span class="token punctuation">.</span>ProcessingErr<span class="token punctuation">:</span>
                            <span class="token punctuation">}</span>

                            <span class="token comment" spellcheck="true">// The Err field can be coerced to a more specific error type with a type</span>
                            <span class="token comment" spellcheck="true">// assertion. This technique can be used to get more specialized</span>
                            <span class="token comment" spellcheck="true">// information for certain errors.</span>
                            <span class="token keyword">if</span> cardErr<span class="token punctuation">,</span> ok <span class="token operator">:=</span> exampleErr<span class="token punctuation">.</span>Err<span class="token punctuation">.</span><span class="token punctuation">(</span><span class="token operator">*</span>example<span class="token punctuation">.</span>CardError<span class="token punctuation">)</span><span class="token punctuation">;</span> ok <span class="token punctuation">{</span>
                            fmt<span class="token punctuation">.</span><span class="token function">Printf</span><span class="token punctuation">(</span><span class="token string">"Card was declined with code: %v\n"</span><span class="token punctuation">,</span> cardErr<span class="token punctuation">.</span>DeclineCode<span class="token punctuation">)</span>
                            <span class="token punctuation">}</span> <span class="token keyword">else</span> <span class="token punctuation">{</span>
                            fmt<span class="token punctuation">.</span><span class="token function">Printf</span><span class="token punctuation">(</span><span class="token string">"Other example error occurred: %v\n"</span><span class="token punctuation">,</span> exampleErr<span class="token punctuation">.</span><span class="token function">Error</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span>
                            <span class="token punctuation">}</span>
                            <span class="token punctuation">}</span> <span class="token keyword">else</span> <span class="token punctuation">{</span>
                            fmt<span class="token punctuation">.</span><span class="token function">Printf</span><span class="token punctuation">(</span><span class="token string">"Other error occurred: %v\n"</span><span class="token punctuation">,</span> err<span class="token punctuation">.</span><span class="token function">Error</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">)</span>
                            <span class="token punctuation">}</span>
                            <span class="token punctuation">}</span></code></pre>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-4-1" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Default Tables</h3>
                        <p>Testabschnitt. Pellentesque mollis sapien nec sapien <code>.table</code> elementum <code>&lt;table&gt;</code>. eu tincidunt elit placerat. Phasellus laoreet vitae mi at hendrerit. Cras in massa ac mi sodales vestibulum. Etiam convallis lectus vitae ligula fermentum, et rutrum odio tincidunt.</p>
                        <p>Nullam <code>.table-exampled</code> et odio rutrum, ornare turpis quis, fermentum <code>&lt;tbody&gt;</code></p>
                        <div class="table-responsive">
                           <table class="table table-exampled">
                              <thead>
                                 <tr>
                                    <td class="text-center"><i class="fa fa-trash"></i></td>
                                    <td>ID</td>
                                    <td>Pretium</td>
                                    <td>bytes</td>
                                    <td>Duis</td>
                                    <td>Urna Neque</td>
                                    <td>Phasellus</td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox6" type="checkbox"><label for="checkbox6"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox7" type="checkbox"><label for="checkbox7"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox8" type="checkbox"><label for="checkbox8"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox9" type="checkbox"><label for="checkbox9"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox10" type="checkbox"><label for="checkbox10"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Default Tables</h5>
                        <div class="table">
                           <table class="table-container">
                              <colgroup>
                                 <col class="col-xs-3">
                                 <col class="col-xs-9">
                              </colgroup>
                              <tbody>
                                 <tr>
                                    <th class="table-row-property">200 - OK</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">400 - Bad Request</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus, Vivamus rhoncus dui vitae eros.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">401 - Unauthorized</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">402 - Request Failed</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">404 - Not Found</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">409 - Conflict</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (dui vitae eros tristique cursus).</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">429 - Too Many Requests</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus Vivamus rhoncus dui vitae eros tristique.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">500, 502, 503, 504 - Server Errors</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (Vivamus rhoncus)</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-4-2" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Exampled Rows</h3>
                        <p>Use <code>.table-exampled</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.</p>
                        <div class="table-responsive">
                           <table class="table table-exampled">
                              <thead>
                                 <tr>
                                    <td>ID</td>
                                    <td>Product</td>
                                    <td>Buyer</td>
                                    <td>Date</td>
                                    <td>Order Note</td>
                                    <td>Payment</td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Exampled Rows</h5>
                        <div class="table">
                           <table class="table-container">
                              <colgroup>
                                 <col class="col-xs-3">
                                 <col class="col-xs-9">
                              </colgroup>
                              <tbody>
                                 <tr>
                                    <th class="table-row-property">200 - OK</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">400 - Bad Request</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus, Vivamus rhoncus dui vitae eros.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">401 - Unauthorized</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">402 - Request Failed</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">404 - Not Found</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">409 - Conflict</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (dui vitae eros tristique cursus).</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">429 - Too Many Requests</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus Vivamus rhoncus dui vitae eros tristique.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">500, 502, 503, 504 - Server Errors</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (Vivamus rhoncus)</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </section>			
			<section id="documenter-4-3" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Bordered Table</h3>
                        <p>Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p>
                        <div class="table-responsive">
                           <table class="table table-bordered table-exampled">
                              <thead>
                                 <tr>
                                    <td class="text-center"><i class="fa fa-trash"></i></td>
                                    <td>ID</td>
                                    <td>Pretium</td>
                                    <td>bytes</td>
                                    <td>Duis</td>
                                    <td>Urna Neque</td>
                                    <td>Phasellus</td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox11" type="checkbox"><label for="checkbox11"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox12" type="checkbox"><label for="checkbox12"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox13" type="checkbox"><label for="checkbox13"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox14" type="checkbox"><label for="checkbox14"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center">
                                       <div class="checkbox margin-t-0"><input id="checkbox15" type="checkbox"><label for="checkbox15"></label></div>
                                    </td>
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Bordered Table</h5>
                        <div class="table">
                           <table class="table-container">
                              <colgroup>
                                 <col class="col-xs-3">
                                 <col class="col-xs-9">
                              </colgroup>
                              <tbody>
                                 <tr>
                                    <th class="table-row-property">200 - OK</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">400 - Bad Request</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus, Vivamus rhoncus dui vitae eros.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">401 - Unauthorized</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">402 - Request Failed</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">404 - Not Found</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">409 - Conflict</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (dui vitae eros tristique cursus).</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">429 - Too Many Requests</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus Vivamus rhoncus dui vitae eros tristique.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">500, 502, 503, 504 - Server Errors</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (Vivamus rhoncus)</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-4-4" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Contextual Classes</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="table-responsive">
                           <table class="table table-bordered table-exampled">
                              <colgroup>
                                 <col class="col-xs-2">
                                 <col class="col-xs-10">
                              </colgroup>
                              <thead>
                                 <tr>
                                    <th>Class</th>
                                    <th>Description</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th scope="row">
                                       <code>.active</code>
                                    </th>
                                    <td>Nunc suscipit justo ac odio condimentum malesuada.</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">
                                       <code>.success</code>
                                    </th>
                                    <td>Nunc suscipit justo ac odio condimentum malesuada.</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">
                                       <code>.info</code>
                                    </th>
                                    <td>Nunc suscipit justo ac odio condimentum malesuada.</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">
                                       <code>.warning</code>
                                    </th>
                                    <td>Nunc suscipit justo ac odio condimentum malesuada.</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">
                                       <code>.danger</code>
                                    </th>
                                    <td>Nunc suscipit justo ac odio condimentum malesuada.</td>
                                 </tr>
                              </tbody>
                           </table>
                           <br>
                           <table class="table">
                              <thead>
                                 <tr>
                                    <td>ID</td>
                                    <td>Pretium</td>
                                    <td>bytes</td>
                                    <td>Duis</td>
                                    <td>Urna Neque</td>
                                    <td>Phasellus</td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr class="active">
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr class="success">
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr class="warning">
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr class="danger">
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                                 <tr class="info">
                                    <td># <b>9652</b></td>
                                    <td>Lorem ipsum dolor sit</td>
                                    <td>John Doe</td>
                                    <td>12/10/2015</td>
                                    <td>Praesent risus velit, egestas et nulla vitae, venenatis elementum nulla.</td>
                                    <td>Credit Card</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Contextual Classes</h5>
                        <div class="table">
                           <table class="table-container">
                              <colgroup>
                                 <col class="col-xs-3">
                                 <col class="col-xs-9">
                              </colgroup>
                              <tbody>
                                 <tr>
                                    <th class="table-row-property">200 - OK</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">400 - Bad Request</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus, Vivamus rhoncus dui vitae eros.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">401 - Unauthorized</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">402 - Request Failed</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">404 - Not Found</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">409 - Conflict</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (dui vitae eros tristique cursus).</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">429 - Too Many Requests</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus Vivamus rhoncus dui vitae eros tristique.</td>
                                 </tr>
                                 <tr>
                                    <th class="table-row-property">500, 502, 503, 504 - Server Errors</th>
                                    <td class="table-row-definition">Vivamus rhoncus dui vitae eros tristique cursus (Vivamus rhoncus)</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </section>            
            <section id="documenter-5" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>General</h3>
                        <br>
                        <h5>Google Web Fonts</h5>
                        <p>Pixxett using <a href="https://www.google.com/fonts" target="_blank">Google Web Font</a>. You can change your fonts only editing one line code.</p>
                        <div class="color1">
                           <p class="font-w-100">Raleway Thin 300</p>
                           <p class="font-w-100"><em>Raleway Thin 300 Italic</em></p>
                           <p class="font-w-200">Raleway Extra-Light </p>
                           <p class="font-w-200"><em>Raleway Extra-Light Italic</em></p>
                           <p class="font-w-300">Raleway Light</p>
                           <p class="font-w-300"><em>Raleway Light Italic</em></p>
                           <p class="font-w-400">Raleway Regular </p>
                           <p class="font-w-400"><em>Raleway Regular Italic</em></p>
                           <p class="font-w-500">Raleway Medium</p>
                           <p class="font-w-500"><em>Raleway Medium Italic</em></p>
                           <p class="font-w-600">Raleway Semi-Bold</p>
                           <p class="font-w-600"><em>Raleway Semi-Bold Italic</em></p>
                           <p class="font-w-700">Raleway Bold</p>
                           <p class="font-w-700"><em>Raleway Bold Italic</em></p>
                           <p class="font-w-800">Raleway Extra-Bold </p>
                           <p class="font-w-800"><em>Raleway Extra-Bold Italic</em></p>
                           <p class="font-w-900">Raleway Black</p>
                           <p class="font-w-900"><em>Raleway Black Italic</em></p>
                        </div>
                        <br>
                        <h5>General Options</h5>
                        <p>We set it line height as <b>26px</b> and default font size as <b>13px</b></p>
                        <h5 class="margin-t-40">Basic Colors</h5>
                        <p class="clearfix">
                           <span class="colorsheme color1-bg"></span>
                           <span class="colorsheme color0-bg"></span>
                           <span class="colorsheme color2-bg"></span>
                           <span class="colorsheme color3-bg"></span>
                           <span class="colorsheme color4-bg"></span>
                        </p>
                        <h5 class="margin-t-40">Theme Colors</h5>
                        <p class="clearfix">
                           <span class="colorsheme color5-bg"></span>
                           <span class="colorsheme color6-bg"></span>
                           <span class="colorsheme color7-bg"></span>
                           <span class="colorsheme color8-bg"></span>
                           <span class="colorsheme color9-bg"></span>
                           <span class="colorsheme color10-bg"></span>
                           <span class="colorsheme color11-bg"></span>
                           <span class="colorsheme color12-bg"></span>
                           <span class="colorsheme color13-bg"></span>
                           <span class="colorsheme color14-bg"></span>
                           <span class="colorsheme color15-bg"></span>
                        </p>
                        <h5 class="margin-t-40">Title Font</h5>
                        <p>Title font is Montserrat. You can add anything as <code>.font-title</code></p>
                        <div class="color1" style="font-size:20px;">
                           <p class="font-w-400 font-title">Montserrat Normal 400</p>
                           <p class="font-w-700 font-title">Montserrat Bold 700</p>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h3>General</h3>
                        <br>
                        <h5>Google Web Fonts</h5>
                        <p>Pixxett using <a href="https://www.google.com/fonts" target="_blank">Google Web Font</a>. You can change your fonts only editing one line code.</p>
                        <div class="color1">
                           <p class="font-w-100">Raleway Thin 300</p>
                           <p class="font-w-100"><em>Raleway Thin 300 Italic</em></p>
                           <p class="font-w-200">Raleway Extra-Light </p>
                           <p class="font-w-200"><em>Raleway Extra-Light Italic</em></p>
                           <p class="font-w-300">Raleway Light</p>
                           <p class="font-w-300"><em>Raleway Light Italic</em></p>
                           <p class="font-w-400">Raleway Regular </p>
                           <p class="font-w-400"><em>Raleway Regular Italic</em></p>
                           <p class="font-w-500">Raleway Medium</p>
                           <p class="font-w-500"><em>Raleway Medium Italic</em></p>
                           <p class="font-w-600">Raleway Semi-Bold</p>
                           <p class="font-w-600"><em>Raleway Semi-Bold Italic</em></p>
                           <p class="font-w-700">Raleway Bold</p>
                           <p class="font-w-700"><em>Raleway Bold Italic</em></p>
                           <p class="font-w-800">Raleway Extra-Bold </p>
                           <p class="font-w-800"><em>Raleway Extra-Bold Italic</em></p>
                           <p class="font-w-900">Raleway Black</p>
                           <p class="font-w-900"><em>Raleway Black Italic</em></p>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-1" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Headings</h3>
                        <br>
                        <h5>Default</h5>
                        <p>All HTML headings, <code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code>, are available. <code>.h1</code> through <code>.h6</code> classes are also available, for when you want to match the font styling of a heading but still want your text to be displayed inline.</p>
                        <h1>h1. Bootstrap heading</h1>
                        <h2>h2. Bootstrap heading</h2>
                        <h3>h3. Bootstrap heading</h3>
                        <h4>h4. Bootstrap heading</h4>
                        <h5>h5. Bootstrap heading</h5>
                        <h6>h6. Bootstrap heading</h6>
                        <br>
                        <h5>Headings with secondary text</h5>
                        <p>Create lighter, secondary text in any heading with a generic <code>&lt;small&gt;</code> tag or the <code>.small</code> class.<br><br></p>
                        <h1>h1. Bootstrap heading <small>Secondary text</small></h1>
                        <h2>h2. Bootstrap heading <small>Secondary text</small></h2>
                        <h3>h3. Bootstrap heading <small>Secondary text</small></h3>
                        <h4>h4. Bootstrap heading <small>Secondary text</small></h4>
                        <h5>h5. Bootstrap heading <small>Secondary text</small></h5>
                        <h6>h6. Bootstrap heading <small>Secondary text</small></h6>
                        <h5 class="margin-t-40">Theme Colors</h5>
                        <p class="clearfix">
                           <span class="colorsheme color5-bg"></span>
                           <span class="colorsheme color6-bg"></span>
                           <span class="colorsheme color7-bg"></span>
                           <span class="colorsheme color8-bg"></span>
                           <span class="colorsheme color9-bg"></span>
                           <span class="colorsheme color10-bg"></span>
                           <span class="colorsheme color11-bg"></span>
                           <span class="colorsheme color12-bg"></span>
                           <span class="colorsheme color13-bg"></span>
                           <span class="colorsheme color14-bg"></span>
                           <span class="colorsheme color15-bg"></span>
                        </p>
                        <h5 class="margin-t-40">Title Font</h5>
                        <p>Title font is Montserrat. You can add anything as <code>.font-title</code></p>
                        <div class="color1" style="font-size:20px;">
                           <p class="font-w-400 font-title">Montserrat Normal 400</p>
                           <p class="font-w-700 font-title">Montserrat Bold 700</p>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Default</h5>
                        <h1>h1. Bootstrap heading</h1>
                        <h2>h2. Bootstrap heading</h2>
                        <h3>h3. Bootstrap heading</h3>
                        <h4>h4. Bootstrap heading</h4>
                        <h5>h5. Bootstrap heading</h5>
                        <h6>h6. Bootstrap heading</h6>
                        <br>
                        <h5>Headings with secondary text</h5>
                        <h1>h1. Bootstrap heading <small>Secondary text</small></h1>
                        <h2>h2. Bootstrap heading <small>Secondary text</small></h2>
                        <h3>h3. Bootstrap heading <small>Secondary text</small></h3>
                        <h4>h4. Bootstrap heading <small>Secondary text</small></h4>
                        <h5>h5. Bootstrap heading <small>Secondary text</small></h5>
                        <h6>h6. Bootstrap heading <small>Secondary text</small></h6>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-2" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Paragraph</h3>
                        <br>
                        <h5>Basic</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pharetra metus a augue pellentesque aliquet. Duis id elit dolor. Pellentesque gravida molestie egestas. Phasellus neque leo, fermentum at lobortis nec, efficitur in ante.</p>
                        <p>Vestibulum enim diam, facilisis eu luctus vel, rhoncus in lectus. Vestibulum faucibus nec elit sed mollis. Vestibulum convallis tellus quis dictum convallis. Vivamus euismod nunc ut dolor finibus, eget gravida eros porta. Suspendisse eu lorem vel ex iaculis venenatis a ut lorem. </p>
                        <p>Vestibulum sed vestibulum neque, sed vehicula lectus. Nam a diam sollicitudin, gravida nisi quis, ultrices dolor. Vestibulum viverra dignissim mollis. Morbi consectetur rhoncus augue nec maximus. Quisque aliquam lacinia metus, a iaculis magna fringilla et. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h4>Lead</h4>
                        <p>Make a paragraph stand out by adding <code>.lead</code>.</p>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pharetra metus a augue pellentesque aliquet. Duis id elit dolor. Pellentesque gravida molestie egestas. Phasellus neque leo, fermentum at lobortis nec, efficitur in ante.Fusce pharetra metus a augue</p>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h3>Paragraph</h3>
                        <br>
                        <h5>Basic</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pharetra metus a augue pellentesque aliquet. Duis id elit dolor. Pellentesque gravida molestie egestas. Phasellus neque leo, fermentum at lobortis nec, efficitur in ante.</p>
                        <p>Vestibulum enim diam, facilisis eu luctus vel, rhoncus in lectus. Vestibulum faucibus nec elit sed mollis. Vestibulum convallis tellus quis dictum convallis. Vivamus euismod nunc ut dolor finibus, eget gravida eros porta. Suspendisse eu lorem vel ex iaculis venenatis a ut lorem. </p>
                        <p>Vestibulum sed vestibulum neque, sed vehicula lectus. Nam a diam sollicitudin, gravida nisi quis, ultrices dolor. Vestibulum viverra dignissim mollis. Morbi consectetur rhoncus augue nec maximus. Quisque aliquam lacinia metus, a iaculis magna fringilla et. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h4>Lead</h4>
                        <p>Make a paragraph stand out by adding <code>.lead</code>.</p>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pharetra metus a augue pellentesque aliquet. Duis id elit dolor. Pellentesque gravida molestie egestas. Phasellus neque leo, fermentum at lobortis nec, efficitur in ante.Fusce pharetra metus a augue</p>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-3" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Inline Text Elements</h3>
                        <br>
                        <h5>Marked Text</h5>
                        <p>You can use the mark tag to <mark>highlight</mark> text.</p>
                        <h5>Deleted text</h5>
                        <p><del>This line of text is meant to be treated as deleted text.</del></p>
                        <h5>Strikethrough text</h5>
                        <p><s>This line of text is meant to be treated as no longer accurate.</s></p>
                        <h5>Inserted text</h5>
                        <p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
                        <h5>Underlined text</h5>
                        <p><u>This line of text will render as underlined</u></p>
                        <h5>Small text</h5>
                        <p><small>This line of text is meant to be treated as fine print.</small></p>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <p>You can use the mark tag to <mark>highlight</mark> text.</p>
                        <p><del>This line of text is meant to be treated as deleted text.</del></p>
                        <p><s>This line of text is meant to be treated as no longer accurate.</s></p>
                        <p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
                        <p><u>This line of text will render as underlined</u></p>
                        <p><small>This line of text is meant to be treated as fine print.</small></p>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-4" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Alignment &amp; Transsformation</h3>
                        <br>
                        <h5>Alignment classes</h5>
                        <p class="text-left">Left aligned text.</p>
                        <p class="text-center">Center aligned text.</p>
                        <p class="text-right">Right aligned text.</p>
                        <p class="text-justify">Justified text.</p>
                        <p class="text-nowrap">No wrap text.</p>
                        <h5>Transformation classes</h5>
                        <p class="text-lowercase">Lowercased text.</p>
                        <p class="text-uppercase">Uppercased text.</p>
                        <p class="text-capitalize">Capitalized text.</p>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Alignment classes</h5>
                        <p class="text-left">Left aligned text.</p>
                        <p class="text-center">Center aligned text.</p>
                        <p class="text-right">Right aligned text.</p>
                        <p class="text-justify">Justified text.</p>
                        <p class="text-nowrap">No wrap text.</p>
                        <h5>Transformation classes</h5>
                        <p class="text-lowercase">Lowercased text.</p>
                        <p class="text-uppercase">Uppercased text.</p>
                        <p class="text-capitalize">Capitalized text.</p>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-5" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Abbreviations</h3>
                        <br>
                        <p>Nunc suscipit justo ac odio condimentum <code>&lt;abbr&gt;</code> malesuada. Duis lacinia blandit egestas. Donec non dui sit amet magna eleifend dignissim. <code>title</code> Integer consectetur mauris a massa malesuada venenatis. Aliquam placerat nulla non interdum venenatis. Orci varius natoque penatibus et magnis dis mus.</p>
                        <h5>Basic abbreviation</h5>
                        Nunc suscipit justo ac odio condimentum <abbr title="attribute">attr</abbr>
                        <h5>Initialism</h5>
                        <abbr title="HyperText Markup Language" class="initialism">HTML</abbr> Nunc suscipit justo ac odio condimentum.
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Abbreviation</h5>
                        <p>Nunc suscipit justo ac odio condimentum <code>&lt;abbr&gt;</code> malesuada. Duis lacinia blandit egestas. Donec non dui sit amet magna eleifend dignissim. <code>title</code> Integer consectetur mauris a massa malesuada venenatis. Aliquam placerat nulla non interdum venenatis. Orci varius natoque penatibus et magnis dis mus.</p>
                        <h5>Basic abbreviation</h5>
                        An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>
                        <h5>Initialism</h5>
                        <abbr title="HyperText Markup Language" class="initialism">HTML</abbr> Nunc suscipit justo ac odio condimentum.
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-6" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Addresses</h3>
                        <br>
                        <address>
                           <strong>Sollicitudin nisi sollicitudin.</strong><br>
                           692 Merry Poe Avenisl, malesuada 201<br>
                           Duis lacinia, EF 1131<br>
                           <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                        <address>
                           <strong>Full Name</strong><br>
                           <a href="mailto:#">first.last@example.com</a>
                        </address>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h5>Addresses</h5>
                        <address>
                           <strong>Sollicitudin nisi sollicitudin.</strong><br>
                           692 Merry Poe Avenisl, malesuada 201<br>
                           Duis lacinia, EF 1131<br>
                           <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                        <address>
                           <strong>Full Name</strong><br>
                           <a href="mailto:#">first.last@example.com</a>
                        </address>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-7" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <div class="col-md-6">
                           <h3>Unordered List </h3>
                           <ul>
                              <li>Home</li>
                              <li>About Us</li>
                              <li>Works</li>
                              <li>
                                 Jobs
                                 <ul>
                                    <li>Designer</li>
                                    <li>Front-end Developer</li>
                                    <li>IOS Developer</li>
                                 </ul>
                              </li>
                              <li>Contact</li>
                           </ul>
                        </div>
                        <div class="col-md-6">
                           <h3>Ordered List</h3>
                           <ol>
                              <li>Home</li>
                              <li>About Us</li>
                              <li>Works</li>
                              <li>
                                 Jobs
                                 <ol>
                                    <li>Designer</li>
                                    <li>Front-end Developer</li>
                                    <li>IOS Developer</li>
                                 </ol>
                              </li>
                              <li>Contact</li>
                           </ol>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <div class="col-md-6">
                           <h3>Unordered List </h3>
                           <ul>
                              <li>Home</li>
                              <li>About Us</li>
                              <li>Works</li>
                              <li>
                                 Jobs
                                 <ul>
                                    <li>Designer</li>
                                    <li>Front-end Developer</li>
                                    <li>IOS Developer</li>
                                 </ul>
                              </li>
                              <li>Contact</li>
                           </ul>
                        </div>
                        <div class="col-md-6">
                           <h3>Ordered List</h3>
                           <ol>
                              <li>Home</li>
                              <li>About Us</li>
                              <li>Works</li>
                              <li>
                                 Jobs
                                 <ol>
                                    <li>Designer</li>
                                    <li>Front-end Developer</li>
                                    <li>IOS Developer</li>
                                 </ol>
                              </li>
                              <li>Contact</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-8" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <div class="col-md-6">
                           <h3>Unstyled List</h3>
                           <ul class="list-unstyled">
                              <li>Home</li>
                              <li>About Us</li>
                              <li>Works</li>
                              <li>
                                 Jobs
                                 <ul>
                                    <li>Designer</li>
                                    <li>Front-end Developer</li>
                                    <li>IOS Developer</li>
                                 </ul>
                              </li>
                              <li>Contact</li>
                           </ul>
                        </div>
                        <div class="col-md-6">
                           <h3>Inline List</h3>
                           <ul class="list-inline">
                              <li>Home</li>
                              <li>Works</li>
                              <li>Jobs</li>
                              <li>Contact</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <div class="col-md-6">
                           <h3>Unstyled List</h3>
                           <ul class="list-unstyled">
                              <li>Home</li>
                              <li>About Us</li>
                              <li>Works</li>
                              <li>
                                 Jobs
                                 <ul>
                                    <li>Designer</li>
                                    <li>Front-end Developer</li>
                                    <li>IOS Developer</li>
                                 </ul>
                              </li>
                              <li>Contact</li>
                           </ul>
                        </div>
                        <div class="col-md-6">
                           <h3>Inline List</h3>
                           <ul class="list-inline">
                              <li>Home</li>
                              <li>Works</li>
                              <li>Jobs</li>
                              <li>Contact</li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-9" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Blockquites </h3>
                        <br>
                        <h5>Default blockquote</h5>
                        <blockquote>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        </blockquote>

                        <h5>Naming a source</h5>
                        <blockquote>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>

                        <h5>Alternate displays</h5>
                        <blockquote class="blockquote-reverse">
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>

                        <h5>Darker Quotes</h5>
                        <blockquote class="darker-grey">
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                           <h5>Sweet pink</h5>
                           <blockquote class="solid-pink">
                              <span class="quote"></span>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                              <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                           </blockquote>
                           <h5>Darker Blue</h5>
                           <blockquote class="darker-blue">
                              <span class="quote"></span>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                              <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                              <span class="quote-right"></span>
                           </blockquote>

                           <h5>Pull Quotes</h5>
                           <blockquote class="pull-quotes">
                              <span class="quote"></span>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                              <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                           </blockquote>
                           <h5>Card Quotes</h5>
                           <blockquote class="card-quotes">
                              <span class="quote"></span>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                              <div class="image-wrapper"><img src="images/profileimg.png" alt="profile image"> </div>
                              <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                           </blockquote>
</div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h3>Blockquites </h3>
                        <br>
                        <h5>Default blockquote</h5>
                        <blockquote>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        </blockquote>

                        <h5>Naming a source</h5>
                        <blockquote>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>

                        <h5>Alternate displays</h5>
                        <blockquote class="blockquote-reverse">
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>

                        <h5>Darker Quotes</h5>
                        <blockquote class="darker-grey">
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                        <h5>Sweet pink</h5>
                        <blockquote class="solid-pink">
                           <span class="quote"></span>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                        <h5>Darker Blue</h5>
                        <blockquote class="darker-blue">
                           <span class="quote"></span>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                           <span class="quote-right"></span>
                        </blockquote>

                        <h5>Pull Quotes</h5>
                        <blockquote class="pull-quotes">
                           <span class="quote"></span>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                        <h5>Card Quotes</h5>
                        <blockquote class="card-quotes">
                           <span class="quote"></span>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum semper arcu at malesuada. Aenean mollis ut justo quis molestie.</p>
                           <div class="image-wrapper"><img src="images/profileimg.png" alt="profile image"> </div>
                           <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                     </div>
                  </div>
               </div>
            </section>
            <section id="documenter-5-10" class="method">
               <div class="method-area">
                  <div class="method-copy">
                     <div class="method-copy-padding">
                        <h3>Descriptions </h3>
                        <br>
                        <h5>Normal</h5>
                        <dl>
                           <dt>Donec lobortis justo at aliquet</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Tempus imperdiet elit</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Praesent interdum</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                        </dl>
                        <br>
                        <h5>Horizontal</h5>
                        <dl class="dl-horizontal">
                           <dt>Donec lobortis justo at aliquet</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Tempus imperdiet elit</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Praesent interdum</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                        </dl>
                     </div>
                  </div>
                  <div class="method-example">
                     <div class="method-example-part">
                        <h3>Descriptions </h3>
                        <br>
                        <h5>Normal</h5>
                        <dl>
                           <dt>Donec lobortis justo at aliquet</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Tempus imperdiet elit</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Praesent interdum</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                        </dl>
                        <br>
                        <h5>Horizontal</h5>
                        <dl class="dl-horizontal">
                           <dt>Donec lobortis justo at aliquet</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Tempus imperdiet elit</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                           <dt>Praesent interdum</dt>
                           <dd>Sed tincidunt pharetra ante, tempus imperdiet elit sodales id. Donec lobortis justo at aliquet luctus. Praesent interdum massa sed ex efficitur, vitae dignissim ante pharetra</dd>
                        </dl>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <!-- Blockquotes mobile menu -->
      <div id="mobile-menu">
         <div class="mobile-menu-inner">
            <ul>
               <li>
                  <div class="mm-search">
                     <form id="search1" name="search">
                        <div class="input-group">
                           <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
                           <div class="input-group-btn">
                              <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </li>
               <li>
                  <a href="#documenter-1">Page links</a>
                  <ul>
                     <li><a href="#documenter-1">API Reference</a> </li>
                     <li><a href="#documenter-2">Authentication </a> </li>
                     <li>
                        <a href="#documenter-3">Errors </a>
                        <ul>
                           <li><a href="#documenter-3-1">Handling errors</a></li>
                        </ul>
                     </li>
                     <li><a href="#documenter-4">Expanding Objects</a> </li>
                     <li><a href="#documenter-5">Idempotent Requests</a> </li>                     
                  </ul>
               </li>
            </ul>
            <div class="top-links">
               <ul class="links">
                  <li><a title="Docs" href="javascript:void(0)">Docs</a> </li>
                  <li><a title="API Reference" href="javascript:void(0)">API Reference</a> </li>
                  <li><a title="Support" href="javascript:void(0)">Support</a> </li>
                  <li><a title="Dashboard" href="javascript:void(0)">Dashboard</a> </li>
                  <li class="last"><a title="Login" href="javascript:void(0)">Login</a> </li>
               </ul>
            </div>
         </div>
      </div>
      <script src="js/prism.js"></script>
      <script src="js/jquery.1.6.4.js"></script>
      <script src="js/jquery.scrollTo-1.4.2-min.js"></script>
      <script src="js/jquery.easing.js"></script>
      <script>document.createElement('section');
         var duration = 500, easing = 'swing';
      </script>
      <script src="js/slides.min.jquery.js"></script>
      <script src="js/script.js"></script>
      <script src="js/scroll.js"></script>
      <script src="js/common.js"></script>
      <script src="js/jquery.mobile-menu.min.js"></script>
      <script>
         ScrollLoad("scrollholder", "scroll", false);
      </script>
   </body>
</html>
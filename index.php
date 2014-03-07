<!DOCTYPE html>
<html lang="en" ng-app>
    <head>
        <meta charset="utf-8">
        <title>Entity Generator</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://bootswatch.com/cosmo/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>
        <script src="assets/script.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Entity Generator</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="https://github.com/remithomas/entity-generator"><i class='fa fa-github-square'></i> Fork me</a></li>
                        <li><a href="http://twiter.com/remi_thomas" target="_blank"><i class='fa fa-twitter-square'></i> remi_thomas</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container" ng-controller="MainCtrl">
            <div class="row">
                <div class="col-lg-12">
                    <div class="jumbotron">
                        <h1>Entity generator</h1>
                        <p class='lead'><i class="fa fa-quote-left"></i> Most loafers are the smartest <i class="fa fa-quote-right"></i></p>
                    </div>
                </div>

                <form>

                    <div class='col-lg-4'>

                        <div class='form-group'>
                            <label>Namespace</label>
                            <input type='text' class='form-control' placeholder="Namespace" value="My\Application" ng-model="namespace" />
                        </div>

                        <div class='form-group'>
                            <label>Class name</label>
                            <input type='text' class='form-control' placeholder="Class name" value="User" ng-model="className" />
                        </div>

                        <div class='form-group'>
                            <label>Constructor</label>
                            <select class='form-control' ng-model='$parent.hasConstructor'>
                                <option value="1">yes</option>
                                <option value="0">no</option>
                            </select>
                        </div>

                        <div class='form-group'>
                            <label>Visibility</label>
                            <select class='form-control' ng-model='$parent.visibility'>
                                <option>protected</option>
                                <option>private</option>
                            </select>
                        </div>

                    </div>
                </form>

                <div class='col-lg-3'>
                    <div ng-init="sort_order='name'">
                        <div ng-repeat="i in items | orderBy:sort_order">
                            <div class='form-group'>
                                <label for='var{{i.name}}'>Var [{{i.name}}]</label>
                                <input placeholder="Variable name" ng-model="i.name" id='var{{i.name}}' value='{{i.name}}' class='form-control ' />

                                <input placeholder="Variable type" class='form-control' ng-model="i.type" />
                            </div>
                        </div>
                    </div>

                    <a ng-click="add()" class='btn btn-primary'>Add variable</a>

                </div>

                <div class='col-lg-5'>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#render" data-toggle="tab">Render</a></li>
                        <li><a href="#raw" data-toggle="tab" ng-click="render()">Raw</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="render">
                            <p>&LT;?php</p>

                            <p>/**<br/>
                                &nbsp;* <br />
                                &nbsp;* @author <br/>
                                &nbsp;*/<br/>
                            </p>
                            
                            <p ng-if="namespace != ''">
                                namespace {{namespace}};
                            </p>

                            <p>class {{className}} {</p>
                            <div ng-repeat="i in items | orderBy:sort_order">
                                <p>/**<br/>
                                    &nbsp;* {{i.name}}<br />
                                    &nbsp;* @var {{i.type}} <br/>
                                    &nbsp;*/<br/>
                                    {{visibility}} ${{i.name}};
                                </p>
                            </div>

                            <p ng-if="hasConstructor == '1'">
                                /**<br/>
                                &nbsp;* Constructor<br />
                                &nbsp;*/<br/>
                            
                                public function __constructor(){

                                }
                            </p>
                            
                            <div ng-repeat="i in items | orderBy:sort_order">
                                <p>/**<br/>
                                    &nbsp;* Set {{i.name}}<br/>
                                    &nbsp;* @param {{i.type}} ${{i.name}}<br/>
                                    &nbsp;* return <span ng-if="namespace != ''">\{{namespace}}\</span>{{className}}<br/>
                                    &nbsp;*/<br/>
                                    public function set{{i.name.substring(0,1).toUpperCase()}}{{i.name.substring(1)}}(${{i.name}}){<br/>
                                        $this->{{i.name}} = ${{i.name}};<br/>
                                        return $this;<br/>
                                    }<br/>
                                </p>
                                <p>/**<br/>
                                    &nbsp;* Get {{i.name}}<br/>
                                    &nbsp;* @param {{i.type}} ${{i.name}}<br/>
                                    &nbsp;*/<br/>
                                    public function get{{i.name.substring(0,1).toUpperCase()}}{{i.name.substring(1)}}(){<br/>
                                        return $this->{{i.name}};<br/>
                                    }<br/>
                                </p>
                            </div>
                            
                            
                            <p>}</p>
                        </div>
                        <div class="tab-pane" id="raw"><textarea class='form-control' rows='12'></textarea></div>
                    </div>

                </div>
            </div>
        </div>

        <footer>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-12'>
                        <ul class='nav nav-pills'>
                            <li><a href="">AngularJS</a></li>
                            <li><a href="http://getbootstrap.com" target="_blank">Bootstrap 3</a></li>
                            <li><a>Jquery</a></li>
                            <li><a>FontAwesome</a></li>
                            <li><a>bootswatch</a></li>
                            <li class="active"><a>Rémi THOMAS 2014</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </footer>

    </body>
</html>
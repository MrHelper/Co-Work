<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>CoWork-AdminCP</title>

<link href="admin/css/bootstrap.min.css" rel="stylesheet">
<link href="admin/css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="admin/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span>Admin</span> control panel</a>
            </div>
                            
        </div><!-- /.container-fluid -->
    </nav>
        
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <ul class="nav menu">
            <li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Event</a></li>
        </ul>
    </div><!--/.sidebar-->
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Event</h1>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form role="form">
                            
                                <div class="form-group">
                                    <label>Title</label>
                                    <input id="ETitle" class="form-control" required="true" placeholder="">
                                </div>
                                
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="EDescription" class="form-control" required="true" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Facebook Link</label>
                                    <input id="EFacebook" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" id="EImage" name="imageup">
                                     <p class="help-block">Please resize image as 1900x1080</p>
                                </div>

                                <button id="btnAdd" class="btn btn-primary">Add</button>
                                <button id="btnEdit" class="btn btn-primary hidden">Edit</button>
                                <button id="btnReset" type="reset" class="btn btn-default">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-->

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Event List</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <table class="table table-hover" id="tblList">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Fb Link</th>
                                        <th style="width:100px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($LEvent as $LE)
                                    <tr>
                                        <td>{{$LE->Title}}</td>
                                        <td>{{$LE->Description}}</td>
                                        <td>{{$LE->Link}}</td>
                                        <td> 
                                        <button type="button" class="btn btn-info btn-edit" style="padding:1px 7px;" EId="{{$LE->id}}" ETitle="{{$LE->Title}}" EDescription="{{$LE->Description}}" EFBLink="{{$LE->Link}}">Edit</button> 
                                        <button type="button" class="btn btn-danger btn-delete" style="padding:1px 7px;" EId="{{$LE->id}}">Del</button> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!--/.row-->
    </div>  <!--/.main-->

    <script src="admin/js/jquery-1.11.1.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script>
        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
                $(this).find('em:first').toggleClass("glyphicon-minus");      
            }); 
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
          if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
          if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        });

        function CheckInput(){
            if( $('#ETitle').val() == "" )
                return false;
            if( $('#EDescription').val() == "" )
                return false;
            return true;
        }
        function CreateEvent(){
            var formData = new FormData;
            
            var title = $('#ETitle').val();
            var description = $('#EDescription').val();
            var FBLink = $('#EFacebook').val();
            var uploadfile = $('input[name=imageup]')[0].files[0];

            formData.append('Title',title);
            formData.append('Description',description);
            formData.append('Facebook',FBLink);
            formData.append('Images',uploadfile);
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('admincp.CreateEvent')}}',
                type: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                dataType: 'JSON',
                success:function(data){
                    location.reload();
                }
            });
        }

        function EditEvent(ID){
            var formData = new FormData;
            var title = $('#ETitle').val();
            var description = $('#EDescription').val();
            var FBLink = $('#EFacebook').val();
            var uploadfile = $('input[name=imageup]')[0].files[0];
            formData.append('id',ID);
            formData.append('Title',title);
            formData.append('Description',description);
            formData.append('Facebook',FBLink);
            formData.append('Images',uploadfile);
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('admincp.EditEvent')}}',
                type: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                dataType: 'JSON',
                success:function(data){
                    location.reload();
                }
            });
        }

        function DeleteEvent(ID){
            var formData = new FormData;
            formData.append('id',ID);
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('admincp.DeleteEvent')}}',
                type: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                dataType: 'JSON',
                success:function(data){
                }
            });
        }

        $('#tblList tbody').on('click','.btn-delete',function(){
            DeleteEvent($(this).attr('EId'));
            $(this).parent().parent().remove();
        });

        $('#tblList tbody').on('click','.btn-edit',function(){
            $('#ETitle').val($(this).attr('ETitle'));
            $('#EDescription').val($(this).attr('EDescription'));
            $('#EFacebook').val($(this).attr('EFBLink'));
            $('#btnAdd').addClass('hidden');
            $('#btnEdit').removeClass('hidden');
            $('#btnEdit').attr('EId',$(this).attr('EId'));
        });

        $('#btnReset').on('click',function(){
            $('#btnEdit').addClass('hidden');
            $('#btnAdd').removeClass('hidden');
        });

        $('#btnAdd').click(function(event){
            event.preventDefault();
            if( CheckInput() )
                CreateEvent();
        });

        $('#btnEdit').click(function(event){
            event.preventDefault();
            var Id = $(this).attr('EId');
            EditEvent(Id);
        });


        function CreateRow(id){
            var title = $('#ETitle').val();
            var description = $('#EDescription').val();
            var FBLink = $('#EFacebook').val();

            var row = "";
            row += '<tr>';
            row += '<td>'+title +'</td>';
            row += '<td>'+ description +'</td>';
            row += '<td>'+ FBLink +'</td>';
            row += '<td> <button type="button" class="btn btn-info btn-edit" style="padding:1px 7px;" EId="'+ id +'" ETitle="'+ title +'" EDescription="'+ description +'" EFBLink="'+ FBLink +'">Edit</button> <button type="button" class="btn btn-danger btn-delete" style="padding:1px 7px;" EId="'+ id +'">Del</button> </td>';
            row += '</tr>';
            $('#tblList tbody').prepend(row);
        }
    </script>   
</body>

</html>

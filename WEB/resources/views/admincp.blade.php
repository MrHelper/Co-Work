<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>CoWork-AdminCP</title>

<link src="{{ asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
<link src="{{ asset('admin/css/styles.css')}}" rel="stylesheet">

<!--Icons-->
<script src="{{ asset('admin/js/lumino.glyphs.js')}}"></script>

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
					<div class="panel-heading">New Event</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form role="form">
							
								<div class="form-group">
									<label>Title</label>
									<input id="ETitle" class="form-control" placeholder="">
								</div>
								
								<div class="form-group">
									<label>Description</label>
									<textarea id="EDescription" class="form-control" rows="3"></textarea>
								</div>

								<div class="form-group">
									<label>Facebook Link</label>
									<input id="EFacebook" class="form-control" placeholder="">
								</div>

								<div class="form-group">
									<label>Image</label>
									<input type="file" id="EImage" name="imageup">
									 <p class="help-block">Please resize image as 1900x1080</p>
								</div>

								<button type="submit" class="btn btn-primary">Add</button>
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="{{ asset('admin/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
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
	            }
	        });
		}
	</script>	
</body>

</html>

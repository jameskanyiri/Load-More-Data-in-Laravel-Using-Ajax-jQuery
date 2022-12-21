<!DOCTYPE html>
<html>

<head>
    <title>Laravel infinite scroll pagination</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style type="text/css">
        .ajax-load {
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Laravel infinite scroll pagination</h2>
        <br />
        <div class="col-md-12" id="post-data">
            @foreach($users as $user)
            <div>
                <h3><a href="">{{ $user->name }}</a></h3>
                <p>{{$user->email}}</p>

                <div class="text-right">
                    <button class="btn btn-success">Read More</button>
                </div>

                <hr style="margin-top:5px;">
            </div>
            @endforeach
        </div>
    </div>
    <div class="ajax-load text-center" style="display:none">
        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
    </div>
    <script type="text/javascript">
        var page = 1;
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	        page++;
	        loadMoreData(page);
	    }
	});

	function loadMoreData(page){
	  $.ajax(
	        {
	            url: '?page=' + page,
	            type: "get",
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data.html == " "){
	                $('.ajax-load').html("No more records found");
	                return;
	            }
	            $('.ajax-load').hide();
	            $("#post-data").append(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
	}
    </script>
</body>

</html>
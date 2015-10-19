/* Main function */
var user = [];
var clothes = [];
var quotes = [];
var outfits = [];
var categories = [];

// Get categories
function getCategories(){
	$.ajax({
		url: "api/categories.php",
		type: "POST",
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				categories = JSON.parse(data);
				var total_clothes = 0;
				var elem = '';
				for(var i=0;i<categories.length;i++){
					total_clothes += Number(categories[i]['total']);
					elem += '<li style="text-transform:capitalize"><a href="clothes.php?category='+categories[i]['name']+'">'+categories[i]['name']+'<span class="label pull-right">'+categories[i]['total']+'</span></a></li>';
				}
				$(".clothes-categories").append('<li><a href="clothes.php">All<span class="label pull-right">'+total_clothes+'</span></a></li>');
				$(".clothes-categories").append(elem);
			}
		}
	})
}

// Get quotes
function getQuotes(){
	$.ajax({
		url: "api/quotes.php",
		type: "POST",
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				quotes = JSON.parse(data);
				var elem = '';
				for(var i=0;i<quotes.length;i++){
					elem +='<blockquote><p>'+quotes[i]['quote']+'</p><footer>'+quotes[i]['author'];
					if(quotes[i]['position']){
						elem += ', <cite title="Source Title">'+quotes[i]['position']+'</cite>';
					}
					elem += '</footer></blockquote>';
				}
				$(".fashion_quotes").append(elem);
			}
		}
	})
}

// Get clothes
function getClothes(category){
	$.ajax({
		url: "api/clothes.php",
		type: "GET",
		data: { _category: category },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				clothes = JSON.parse(data);
				var recent_category = clothes[0]['category'];
				var elem = '';
				elem += '<h2 class="page-header">'+toTitleCase(recent_category)+'</h2>';
				for(var i=0;i<clothes.length;i++){
					if(clothes[i]['category']!=recent_category){
						recent_category = clothes[i]['category'];
						elem += '<h2 class="page-header">'+toTitleCase(recent_category)+'</h2>';
					}
					elem += '<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+clothes[i]['photo']+'" alt="image" /></a>';
				}
				$(".clothes_gallery").append(elem);
			}
		}
	})
}

// Get clothes
function getClothesDetail(id){
	$.ajax({
		url: "api/clothes-detail.php",
		type: "GET",
		data: { _id: id },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				var elem = '';
				var clothes_detail = JSON.parse(data);
				// Photo
				var photo;
				if(clothes_detail[0]['photo']) photo = clothes_detail[0]['photo'];
				else photo = "Add photo";
				elem = '<img width=300 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" />';
				$(".clothes_photo").append(elem);
				// Brand
				var brand;
				if(clothes_detail[0]['brand']) brand = toTitleCase(clothes_detail[0]['brand']);
				else brand = "Add brand";
				elem = '<input type="text" class="form-control" placeholder="'+brand+'">';
				$(".clothes_brand").append(elem);
				// Color
				var color;
				if(clothes_detail[0]['color']) color = toTitleCase(clothes_detail[0]['color']);
				else color = "Add color(s)";
				elem = '<input type="text" class="form-control" placeholder="'+color+'">';
				$(".clothes_color").append(elem);
				// Pattern
				var pattern;
				if(clothes_detail[0]['pattern']) pattern = toTitleCase(clothes_detail[0]['pattern']);
				else pattern = "Add pattern(s)";
				elem = '<input type="text" class="form-control" placeholder="'+pattern+'">';
				$(".clothes_pattern").append(elem);
				// Retailer
				var retailer;
				if(clothes_detail[0]['retailer']) retailer = toTitleCase(clothes_detail[0]['retailer']);
				else retailer = "Add retailer(s)";
				elem = '<input type="text" class="form-control" placeholder="'+retailer+'">';
				$(".clothes_retailer").append(elem); 
				// Price
				var price;
				if(clothes_detail[0]['price']) price = clothes_detail[0]['price'];
				else price = "Add price";
				elem = '<input type="text" class="form-control" placeholder="'+price+'">';
				$(".clothes_price").append(elem);
				// Occasion
				var occasion;
				if(clothes_detail[0]['occasion']) occasion = toTitleCase(clothes_detail[0]['occasion']);
				else occasion = "Add occasion";
				elem = '<input type="text" class="form-control" placeholder="'+occasion+'">';
				$(".clothes_occasion").append(elem);
				$(".clothes_history").append(elem);
			}
		}
	})
}

// Get matches
function getMatches(id){
	$.ajax({
		url: "api/matches.php",
		type: "GET",
		data: { _id: id },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				clothes = JSON.parse(data);
				var recent_category = clothes[0]['category'];
				var elem = '';
				elem += '<h2 class="page-header">'+toTitleCase(recent_category)+'</h2>';
				for(var i=0;i<clothes.length;i++){
					if(clothes[i]['category']!=recent_category){
						recent_category = clothes[i]['category'];
						elem += '<h2 class="page-header">'+toTitleCase(recent_category)+'</h2>';
					}
					elem += '<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+clothes[i]['photo']+'" alt="image" /></a>';
				}
				$(".clothes_matches").append(elem);
			}
		}
	})
}

// Get layers
function getLayers(id){
	$.ajax({
		url: "api/layers.php",
		type: "GET",
		data: { _id: id },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				clothes = JSON.parse(data);
				var recent_category = clothes[0]['category'];
				var elem = '';
				elem += '<h2 class="page-header">'+toTitleCase(recent_category)+'</h2>';
				for(var i=0;i<clothes.length;i++){
					if(clothes[i]['category']!=recent_category){
						recent_category = clothes[i]['category'];
						elem += '<h2 class="page-header">'+toTitleCase(recent_category)+'</h2>';
					}
					elem += '<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+clothes[i]['photo']+'" alt="image" /></a>';
				}
				$(".clothes_layers").append(elem);
			}
		}
	})
}

// Title Case
function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
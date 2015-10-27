var user = [];
var clothes = [];
var quotes = [];
var outfits = [];
var categories = [];

/* -------------------------- Main Functions -------------------------- */

// Get categories
function getCategorySidebar(){
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

// Get categories for page
function getCategory(category){
	$.ajax({
		url: "api/categories.php",
		type: "GET",
		data: { _category: category },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				categories = JSON.parse(data);
				var total_clothes = 0;
				var elem = '';
				for(var i=0;i<categories.length;i++){
					total_clothes += Number(categories[i]['total']);
					elem += '<div class="'+categories[i]['name']+'" id="'+categories[i]['name']+'" style="display:none"><h2 class="page-header"><a href="clothes.php?category='+categories[i]['name']+'">'+toTitleCase(categories[i]['name'])+'</a> ('+categories[i]['total']+')</h2></div>';
				}
				$(".clothes_gallery").append(elem);
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
function getClothes(category,start,limit){
	$.ajax({
		url: "api/clothes.php",
		type: "GET",
		data: { _category: category, _start: start, _limit: limit },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				clothes = JSON.parse(data);
				var elem = "";
				var photo = "";
				for(var i=0;i<clothes.length;i++) {
					document.getElementById(clothes[i]['category']).style="display:block";
					if(clothes[i]['photo']) {
						photo = clothes[i]['photo'];
					} else {
						photo = "add.jpg";
					}
					$("."+clothes[i]['category']+"").append('<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" /></a>');
				}
			}
		}
	})
}

// Get clothes detail
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
				else photo = "add.jpg";
				elem = '<img width=300 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" />';
				$(".clothes_photo").append(elem);
				// Fav
				var fav;
				if(clothes_detail[0]['fav']) fav = clothes_detail[0]['fav'];
				else fav = "";
				elem = '<input type="text" class="form-control" name="fav" placeholder="1/0" value="'+fav+'">';
				$(".clothes_fav").append(elem);
				// Category
				var category;
				if(clothes_detail[0]['category']) category = clothes_detail[0]['category'];
				else category = "";
				elem = '<input type="text" class="form-control" name="category" placeholder="Add category" value="'+category+'">';
				$(".clothes_category").append(elem);
				// Brand
				var brand;
				if(clothes_detail[0]['brand']) brand = toTitleCase(clothes_detail[0]['brand']);
				else brand = "";
				elem = '<input type="text" class="form-control" name="brand" placeholder="Add brand" value="'+brand+'">';
				$(".clothes_brand").append(elem);
				// Color
				var color;
				if(clothes_detail[0]['color']) color = toTitleCase(clothes_detail[0]['color']);
				else color = "";
				elem = '<input type="text" class="form-control" name="color" placeholder="Add color(s)" value="'+color+'">';
				$(".clothes_color").append(elem);
				// Pattern
				var pattern;
				if(clothes_detail[0]['pattern']) pattern = toTitleCase(clothes_detail[0]['pattern']);
				else pattern = "";
				elem = '<input type="text" class="form-control" name="pattern" placeholder="Add pattern(s)" value="'+pattern+'">';
				$(".clothes_pattern").append(elem);
				// Retailer
				var retailer;
				if(clothes_detail[0]['retailer']) retailer = toTitleCase(clothes_detail[0]['retailer']);
				else retailer = "";
				elem = '<input type="text" class="form-control" name="retailer" placeholder="Add retailer" value="'+retailer+'">';
				$(".clothes_retailer").append(elem); 
				// Price
				var price;
				if(clothes_detail[0]['price']) price = clothes_detail[0]['price'];
				else price = "";
				elem = '<input type="text" class="form-control" name="price" placeholder="Add price" value="'+price+'">';
				$(".clothes_price").append(elem);
				// Occasion
				var occasion;
				if(clothes_detail[0]['occasion']) occasion = toTitleCase(clothes_detail[0]['occasion']);
				else occasion = "";
				elem = '<input type="text" class="form-control" name="occasion" placeholder="Add occasion" value="'+occasion+'">';
				$(".clothes_occasion").append(elem);

				$(".clothes_title").append('<h3><i class="fa fa-folder-open"></i> <a href="clothes.php">All Clothes</a> <i class="fa fa-angle-right"></i> <a href="clothes.php?category='+category+'">'+toTitleCase(category)+'</a> <i class="fa fa-angle-right"></i> Item '+id+'</h3>');
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
				var recent_category = toTitleCase(clothes[0]['category']);
				var elem = '';
				elem += '<h2 class="page-header">'+recent_category+'</h2>';
				for(var i=0;i<clothes.length;i++){
					if(toTitleCase(clothes[i]['category'])!=recent_category){
						recent_category = toTitleCase(clothes[i]['category']);
						elem += '<h2 class="page-header">'+recent_category+'</h2>';
					}
					elem += '<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=150 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+clothes[i]['photo']+'" alt="image" /></a>';
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
				var recent_category = toTitleCase(clothes[0]['category']);
				var elem = '';
				elem += '<h2 class="page-header">'+recent_category+'</h2>';
				for(var i=0;i<clothes.length;i++){
					if(toTitleCase(clothes[i]['category'])!=recent_category){
						recent_category = toTitleCase(clothes[i]['category']);
						elem += '<h2 class="page-header">'+recent_category+'</h2>';
					}
					elem += '<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=150 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+clothes[i]['photo']+'" alt="image" /></a>';
				}
				$(".clothes_layers").append(elem);
			}
		}
	})
}

// Get clothes to match
function getClothesToMatch(id){
	$.ajax({
		url: "api/clothes-to-match.php",
		type: "GET",
		data: { _id: id },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				clothes = JSON.parse(data);
				var recent_category = toTitleCase(clothes[0]['category']);
				var elem = '';
				elem += '<h2 class="page-header">'+recent_category+'</h2>';
				for(var i=0;i<clothes.length;i++){
					if(toTitleCase(clothes[i]['category'])!=recent_category){
						recent_category = toTitleCase(clothes[i]['category']);
						elem += '<h2 class="page-header">'+recent_category+'</h2>';
					}
					if(clothes[i]["match"]) {
						elem += '<a href="api/remove-match.php?id1='+id+'&id2='+clothes[i]['id']+'"><img width=150 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+clothes[i]['photo']+'" alt="image" /></a>';
					} else {
						elem += '<a href="api/add-match.php?id1='+id+'&id2='+clothes[i]['id']+'"><img width=150 style="opacity: 0.2; padding: .1em; border-radius: 10px;" src="images/azalea/'+clothes[i]['photo']+'" alt="image" /></a>';
					}
				}
				$(".clothes_to_match").append(elem);
			}
		}
	})
}

// Get clothes for outfit
function getClothesForOutfit(start,limit){
	$.ajax({
		url: "api/clothes.php",
		type: "GET",
		data: { _start: start, _limit: limit },
		beforeSend: function() {
		},
		success: function(data,status){
			if(status=="success") {
				clothes = JSON.parse(data);
				var elem = '';
				for(var i=0;i<clothes.length;i++){
					id = clothes[i]['id'];
					if(clothes[i]['photo']) photo = clothes[i]['photo'];
					else photo = "add.jpg";
					$("."+clothes[i]['category']+"").append('<label for="clothes_'+id+'" id="clothes_'+id+'" style="opacity:0.2" onclick="fade(this.id)"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" /></label>&nbsp;');
					createCheckbox("clothes_"+id,"clothes[]",id,"flat",clothes[i]['category'],clothes[i]['checked']);
					document.getElementById(clothes[i]['category']).style="display:block";
				}
			}
		}
	})
}

// Get clothes for edit outfit
function getClothesForEditOutfit(id, start,limit){
	$.ajax({
		url: "api/clothes-checked.php",
		type: "GET",
		data: { _id: id, _start: start, _limit: limit },
		beforeSend: function() {
		},
		success: function(data,status){
			if(status=="success") {
				clothes = JSON.parse(data);
				var elem = '';
				for(var i=0;i<clothes.length;i++){
					id = clothes[i]['id'];
					if(clothes[i]['photo']) photo = clothes[i]['photo'];
					else photo = "add.jpg";
					if(clothes[i]["checked"]) {
						$("."+clothes[i]['category']+"").append('<label for="clothes_'+id+'" id="clothes_'+id+'" style="opacity:1" onclick="fade(this.id)"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" /></label>&nbsp;');
						createCheckbox("clothes_"+id,"clothes[]",id,"flat",clothes[i]['category'],clothes[i]["checked"]);
					} else {
						$("."+clothes[i]['category']+"").append('<label for="clothes_'+id+'" id="clothes_'+id+'" style="opacity:0.2" onclick="fade(this.id)"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" /></label>&nbsp;');
						createCheckbox("clothes_"+id,"clothes[]",id,"flat",clothes[i]['category'],clothes[i]["checked"]);
					
					}
					document.getElementById(clothes[i]['category']).style="display:block";
				}
			}
		}
	})
}

// Get outfits
function getOutfits(start,limit){
	$.ajax({
		url: "api/outfits.php",
		type: "GET",
		data: { _start: start, _limit: limit },
		beforeSend: function() {
		},
		success: function(data,status) {
			if(status=="success") {
				outfits = JSON.parse(data);
				var elem = '';
				var clothes = [];
				for(var i=0;i<outfits.length;i++) {
					elem += '<div class="col-md-12 col-sm-12 col-xs-12">';
					elem += '<h2 class="page-header"><a href="outfit-detail.php?id='+outfits[i]['id']+'">Outfit '+outfits[i]["id"]+'</a></h2>';
					clothes = (outfits[i]["clothes"]);
					var photo = "";
					for(var j=0;j<clothes.length;j++) {
						if(clothes[j]['photo']) photo = clothes[j]['photo'];
						else photo = "add.jpg";
						elem += '<a href="clothes-detail.php?id='+clothes[j]['id']+'"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" alt="image" /></a>';
					}
					elem += '</div>';
				}
				$(".clothes_gallery").append(elem);
			}
		}
	})
}

// Get clothes detail
function getOutfitDetail(id){
	$.ajax({
		url: "api/outfits.php",
		type: "GET",
		data: { _id: id },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success") {
				outfits = JSON.parse(data);
				var elem = '';
				var clothes = [];
				for(var i=0;i<outfits.length;i++) {
					elem += '<div class="col-md-12 col-sm-12 col-xs-12">';
					clothes = (outfits[i]["clothes"]);
					var photo = "";
					for(var j=0;j<clothes.length;j++) {
						if(clothes[j]['photo']) photo = clothes[j]['photo'];
						else photo = "add.jpg";
						elem += '<a href="clothes-detail.php?id='+clothes[j]['id']+'"><img width=200 style="padding: .1em; border-radius: 10px;" src="images/azalea/'+photo+'" alt="image" /></a>';
					}
					elem += '</div>';
				}
				$(".clothes_content").append(elem);
				$(".clothes_title").append('<h3><i class="fa fa-folder-open"></i> <a href="outfits.php">All Outfits</a> <i class="fa fa-angle-right"></i> Outfit No '+id+'</h3>');
			}
		}
	})
}

/* -------------------------- Side Functions -------------------------- */

// Create div
function createDiv(id,className,style,IDParent) {
	var div = document.createElement("div");
	div.id = id;
	div.className = className;
	div.style = style;
	document.getElementById(IDParent).appendChild(div);
}

// Create checkbox (for image as checkbox)
function createCheckbox(id,name,value,className,IDParent,checked) {
	var input = document.createElement("input");
	input.type = "checkbox";
	input.id = id;
	input.name = name;
	input.value = value;
	input.className = className;
	input.checked = checked;
	document.getElementById(IDParent).appendChild(input);
	$("input[type='checkbox']").iCheck({checkboxClass: 'icheckbox_flat-green'}); //wrap with iCheck
	$(".icheckbox_flat-green").attr({"style": "display:none"}); //hide the checkbox
}

// Fade an element
function fade(id) {
	if(document.getElementById(id).style.opacity=="0.2") {
		document.getElementById(id).style.opacity="1";
	} else if(document.getElementById(id).style.opacity=="1") {
		document.getElementById(id).style.opacity="0.2";
	}
}

// Title Case
function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
// DATABASE
// Set Database Mode
function setDBMode(db_mode) {
	$.ajax({
		url: "session.php",
		type: "GET",
		data: { _db_mode: db_mode },
		beforeSend: function(){
		},
		success: function(data,status) {
		}
	})
}

// CATEGORIES
// Categories for sidebar
function getCategorySidebar() {
	$.ajax({
		url: "api/categories.php",
		type: "POST",
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				var categories = JSON.parse(data);
				var total_all = 0;
				var elem = "";
				// Element categories
				for(var i=0;i<categories.length;i++) {
					var name = categories[i]['name'];
					var total = categories[i]['total'];
					total_all += Number(total);
					elem += '<li style="text-transform:capitalize">';
					elem += '<a href="clothes.php?category='+name+'">'+name+'<span class="label pull-right">'+total+'</span></a>';
					elem += '</li>';
				}
				// Element all
				var elem_all = '';
				elem_all += '<li>';
				elem_all += '<a href="clothes.php">All<span class="label pull-right">'+total_all+'</span></a>';
				elem_all += '</li>';
				// Append
				$(".clothes-categories").append(elem_all);
				$(".clothes-categories").append(elem);
			}
		}
	})
}
// Header categories for gallery
function getCategory(category) {
	$.ajax({
		url: "api/categories.php",
		type: "GET",
		data: { category: category },
		beforeSend: function(){
		},
		success: function(data,status) {
			if(status=="success"){
				var categories = JSON.parse(data);
				var total_clothes = 0;
				var elem = "";
				// Element header category
				for(var i=0;i<categories.length;i++) {
					total_clothes += Number(categories[i]['total']);
					elem += '<div class="'+categories[i]['name']+'" id="'+categories[i]['name']+'" style="display:none">';
					elem += '<h2 class="page-header">';
					elem += '<a href="clothes.php?category='+categories[i]['name']+'">'+toTitleCase(categories[i]['name'])+'</a> ('+categories[i]['total']+')';
					elem += '</h2>';
					elem += '</div>';	
				}
				// Append
				$(".clothes_gallery").append(elem);
			}
		}
	})
}
// Category option for generate outfit
function getCategoryOption() {
	$.ajax({
		url: "api/categories.php",
		type: "POST",
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				categories = JSON.parse(data);
				var elem = '';
				for(var i=0;i<categories.length;i++){
					category = categories[i]['name'];
					$(".category_options").append('<div class="checkbox '+category+'_option" id="'+category+'_option"></div>');
					createCheckbox(category,"category[]",category,"",category+"_option",1,"");
					$("."+category+"_option").append(" "+toTitleCase(category));
				}
			}
		}
	})
}

// CLOTHES
// Get clothes for gallery
function getClothes(category) {
	$.ajax({
		url: "api/clothes.php",
		type: "GET",
		data: { category: category },
		beforeSend: function() {

		},
		success: function(data,status) {
			if(status=="success") {
				var clothes = JSON.parse(data);
				var elem = "";
				var categories = [];
				if(clothes.length!=0) {
					for(var i=0;i<clothes.length;i++) {
						// Append new clothes
						if(categories.indexOf(clothes[i]['category'])==-1) {
							$("."+clothes[i]['category']+"").append('<a href="add-clothes.php?category='+clothes[i]['category']+'"><img width=200 style="padding: .1em;" src="images/New Clothes.jpg" /></a>');
							categories.push(clothes[i]['category']);
						}
						// Append clothes
						document.getElementById(clothes[i]['category']).style="display:block";
						$("."+clothes[i]['category']+"").append('<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=200 style="padding: .1em;" src="'+clothes[i]['photo']+'" /></a>');
					}	
				}
				if(category=="") {
					$(".clothes_title").append('<h3><i class="fa fa-folder-open"></i> <a href="clothes.php">All Clothes</a></h3>');
				} else {
					$(".clothes_title").append('<h3><i class="fa fa-folder-open"></i> <a href="clothes.php">All Clothes</a> <i class="fa fa-angle-right"></i> <a href="clothes.php?category='+category+'">'+toTitleCase(category)+'</a></h3>');
				}
			}
		}
	})
}
// Get clothes detail
function getClothesDetail(id) {
	$.ajax({
		url: "api/clothes-detail.php",
		type: "GET",
		data: { id: id },
		beforeSend: function(){
		},
		success: function(data,status) {
			if(status=="success") {
				var clothes_detail = JSON.parse(data);
				var elem = '';
				
				// Owner
				var owner = clothes_detail[0]['owner'];
				elem = '<input type="text" class="form-control" name="owner" placeholder="Add owner" value="'+owner+'" disabled>';
				$(".clothes_owner").append(elem);

				// Photo
				var photo = clothes_detail[0]['photo'];
				elem = '<img width=300 style="padding: .1em;" src="'+photo+'" />';
				$(".clothes_photo").append(elem);
				// Fav
				var fav = clothes_detail[0]['fav'];
				elem = '<input type="text" class="form-control" name="fav" placeholder="1/0" value="'+fav+'">';
				$(".clothes_fav").append(elem);
				// Category
				var category = clothes_detail[0]['category'];
				elem = '<input type="text" class="form-control" name="category" placeholder="Add category" value="'+category+'">';
				$(".clothes_category").append(elem);
				// Brand
				var brand = clothes_detail[0]['brand'];
				elem = '<input type="text" class="form-control" name="brand" placeholder="Add brand" value="'+brand+'">';
				$(".clothes_brand").append(elem);
				// Color
				var color = clothes_detail[0]['color'];
				elem = '<input type="text" class="form-control" name="color" placeholder="Add color(s)" value="'+color+'">';
				$(".clothes_color").append(elem);
				// Pattern
				var pattern = clothes_detail[0]['pattern'];
				elem = '<input type="text" class="form-control" name="pattern" placeholder="Add pattern(s)" value="'+pattern+'">';
				$(".clothes_pattern").append(elem);
				// Retailer
				var retailer = clothes_detail[0]['retailer'];
				elem = '<input type="text" class="form-control" name="retailer" placeholder="Add retailer" value="'+retailer+'">';
				$(".clothes_retailer").append(elem); 
				// Price
				var price = clothes_detail[0]['price'];
				elem = '<input type="text" class="form-control" name="price" placeholder="Add price" value="'+price+'">';
				$(".clothes_price").append(elem);
				// Occasion
				var occasion = clothes_detail[0]['occasion'];
				elem = '<input type="text" class="form-control" name="occasion" placeholder="Add occasion" value="'+occasion+'">';
				$(".clothes_occasion").append(elem);

				$(".clothes_title").append('<h3><i class="fa fa-folder-open"></i> <a href="clothes.php">All Clothes</a> <i class="fa fa-angle-right"></i> <a href="clothes.php?category='+category+'">'+toTitleCase(category)+'</a> <i class="fa fa-angle-right"></i> Item '+id+'</h3>');
			}
		}
	})
}

// MATCHES
// Get matches
function getMatches(id) {
	$.ajax({
		url: "api/matches.php",
		type: "GET",
		data: { id: id },
		beforeSend: function() {
		},
		success: function(data,status) {
			if(status=="success") {
				clothes = JSON.parse(data);
				var elem = '';
				// Elements to append
				for(var i=0;i<clothes.length;i++) {
					elem = '<a href="clothes-detail.php?id='+clothes[i]['id']+'"><img width=150 style="padding: .1em;" src="'+clothes[i]['photo']+'" alt="image" /></a>';
					$("#matches > .clothes_gallery > ."+clothes[i]['category']+"").append(elem);
					$("#matches > .clothes_gallery > ."+clothes[i]['category']+"").css('display', 'block');
				}
			}
		}
	})
}
// Get clothes to match
function getClothesToMatch(id) {
	$.ajax({
		url: "api/clothes-to-match.php",
		type: "GET",
		data: { id: id },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success") {
				clothes = JSON.parse(data);
				var categories = [];
				for(var i=0;i<clothes.length;i++) {
					var elem = '';
					var id2 = clothes[i]['id'];
					var category = clothes[i]['category'];
					var checked = clothes[i]['checked'];
					var photo = clothes[i]['photo'];
					createCheckbox("clothes_"+id2,"clothes[]",id2,category,checked,"display:none");
					if(checked=="checked") {
						elem += '&nbsp;<label for="clothes_'+id2+'" id="fade_'+id2+'" style="opacity:1" onclick="editMatch(this.id,'+id+','+id2+')">';
					} else {
						elem += '&nbsp;<label for="clothes_'+id2+'" id="fade_'+id2+'" style="opacity:0.2" onclick="editMatch(this.id,'+id+','+id2+')">';
					}
					elem += '<img width=150 style="padding: .1em;" src="'+photo+'" />';
					elem += '</label>';
					// Append new clothes
					if(categories.indexOf(category)==-1) {
						$("#done > .clothes_gallery > ."+category+"").append('<a href="add-clothes.php?category='+category+'"><img width=150 style="padding: .1em;" src="images/New Clothes.jpg" /></a>');
						categories.push(category);
					}
					// Append clothes matches
					$("#done > .clothes_gallery > ."+category+"").append(elem);
					$("#done > .clothes_gallery > ."+category+"").css('display', 'block');
				}
			}
		}
	})
}
// Edit match
function editMatch(id,id1,id2) {
	if(document.getElementById(id).style.opacity=="1") {
		removeMatch(id1,id2);
	} else if(document.getElementById(id).style.opacity=="0.2") {
		addMatch(id1,id2);
	}
	fade(id);
}
// Add match
function addMatch(id1,id2) {
	$.ajax({
		url: "api/add-match.php",
		type: "GET",
		data: { id1: id1, id2: id2 },
		beforeSend: function() {
		},
		success: function() {
			new PNotify({
				title: 'Successfully Added!',
				text: 'You just added a matching clothes',
				type: 'dark',
				nonblock: {
					nonblock: true,
					nonblock_opacity: .2
				}
			});
		}
	})	
}
// Remove match
function removeMatch(id1,id2) {
	$.ajax({
		url: "api/remove-match.php",
		type: "GET",
		data: { id1: id1, id2: id2 },
		beforeSend: function() {
		},
		success: function() {
			new PNotify({
				title: 'Successfully Removed!',
				text: 'You just removed a matching clothes',
				type: 'dark',
				nonblock: {
					nonblock: true,
					nonblock_opacity: .2
				}
			});
		}
	})
}

// OUTFIT
// Get clothes to create outfit
function getClothesToCreateOutfit() {
	$.ajax({
		url: "api/clothes.php",
		type: "POST",
		beforeSend: function() {
		},
		success: function(data,status) {
			if(status=="success") {
				clothes = JSON.parse(data);
				var categories = [];
				for(var i=0;i<clothes.length;i++) {
					var elem = '';
					id = clothes[i]['id'];
					createCheckbox("clothes_"+id,"clothes[]",id,clothes[i]['category'],clothes[i]['checked'],"display:none");
					elem += '&nbsp;<label for="clothes_'+id+'" id="fade_'+id+'" style="opacity:0.2" onclick="fade(this.id)">';
					elem += '<img width=200 style="padding: .1em;" src="'+clothes[i]['photo']+'" />';
					elem += '</label>';
					// Append new clothes
					if(categories.indexOf(clothes[i]['category'])==-1) {
						$("."+clothes[i]['category']+"").append('<a href="add-clothes.php?category='+clothes[i]['category']+'"><img width=200 style="padding: .1em;" src="images/New Clothes.jpg" /></a>');
						categories.push(clothes[i]['category']);
					}
					// Append clothes
					$("."+clothes[i]['category']+"").append(elem);
					$("."+clothes[i]['category']+"").css('display', 'block');
				}
			}
		}
	})
}
// Get clothes for edit outfit
function getClothesToEditOutfit(id,start,limit) {
	$.ajax({
		url: "api/clothes-to-outfit.php",
		type: "GET",
		data: { id: id, start: start, limit: limit },
		beforeSend: function() {
		},
		success: function(data,status){
			if(status=="success") {
				clothes = JSON.parse(data);
				for(var i=0;i<clothes.length;i++) {
					var elem = '';
					var id2 = clothes[i]['id'];
					var category = clothes[i]['category'];
					var checked = clothes[i]['checked'];
					var photo = clothes[i]['photo'];
					createCheckbox("clothes_"+id2,"clothes[]",id2,category,checked,"display:none");
					if(checked=="checked") {
						elem += '&nbsp;<label for="clothes_'+id2+'" id="fade_'+id2+'" style="opacity:1" onclick="editOutfit(this.id,'+id+','+id2+')">';
					} else {
						elem += '&nbsp;<label for="clothes_'+id2+'" id="fade_'+id2+'" style="opacity:0.2" onclick="editOutfit(this.id,'+id+','+id2+')">';
					}
					elem += '<img width=200 style="padding: .1em;" src="'+photo+'" />';
					elem += '</label>';
					$("."+category+"").append(elem);
					document.getElementById(category).style="display:block";
				}
			}

		}
	})
}
// Edit outfit
function editOutfit(id,id1,id2) {
	if(document.getElementById(id).style.opacity=="1") {
		removeFromOutfit(id1,id2);
	} else if(document.getElementById(id).style.opacity=="0.2") {
		addToOutfit(id1,id2);
	}
	fade(id);
}
// Add to outfit
function addToOutfit(id1,id2) {
	$.ajax({
		url: "api/add-to-outfit.php",
		type: "GET",
		data: { id1: id1, id2: id2 },
		beforeSend: function() {
		},
		success: function() {
			new PNotify({
				title: 'Successfully Added!',
				text: 'You just added a clothes to this outfit',
				type: 'dark',
				nonblock: {
					nonblock: true,
					nonblock_opacity: .2
				}
			});
		}
	})	
}
// Remove from outfit
function removeFromOutfit(id1,id2) {
	$.ajax({
		url: "api/remove-from-outfit.php",
		type: "GET",
		data: { id1: id1, id2: id2 },
		beforeSend: function() {
		},
		success: function() {
			new PNotify({
				title: 'Successfully Removed!',
				text: 'You just removed a clothes from this outfit',
				type: 'dark',
				nonblock: {
					nonblock: true,
					nonblock_opacity: .2
				}
			});
		}
	})
}
// Get outfits
function getOutfits(start,limit) {
	$.ajax({
		url: "api/outfits.php",
		type: "GET",
		data: { start: start, limit: limit },
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
					clothes = outfits[i]["clothes"];
					for(var j=0;j<clothes.length;j++) {
						elem += '<a href="clothes-detail.php?id='+clothes[j]['id']+'">';
						elem += '<img width=200 style="padding: .1em;" src="'+clothes[j]['photo']+'" alt="image" />';
						elem += '</a>';
					}
					elem += '</div>';
				}
				$(".clothes_gallery").append(elem);
			}
		}
	})
}
// Get outfit detail
function getOutfitDetail(id) {
	$.ajax({
		url: "api/outfit-detail.php",
		type: "GET",
		data: { id: id },
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success") {
				var outfit = JSON.parse(data);
				$(".clothes_title").append('<h3><i class="fa fa-folder-open"></i> <a href="outfits.php">All Outfits</a> <i class="fa fa-angle-right"></i> Outfit No '+outfit[0]['id']+'</h3>');
				var elem = '';
				var clothes = outfit[0]["clothes"];
				elem += '<div class="col-md-12 col-sm-12 col-xs-12">';
				for(var i=0;i<clothes.length;i++) {
					elem += '<a href="clothes-detail.php?id='+clothes[i]['id']+'">';
					elem += '<img width=200 style="padding: .1em;" src="'+clothes[i]['photo']+'" alt="image" />';
					elem += '</a>';	
				}
				elem += '</div>';
				$(".clothes_content").append(elem);		
			}
		}
	})
}
// Generate outfit
function generateOutfit() {
	$.ajax({
		url: "api/generate-outfit.php",
		type: "GET",
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
			
			}
		}
	})
}

// SIDE
// Get quotes
function getQuotes() {
	$.ajax({
		url: "api/quotes.php",
		type: "POST",
		beforeSend: function(){
		},
		success: function(data,status){
			if(status=="success"){
				var quotes = JSON.parse(data);
				var elem = "";
				// Element quotes
				for(var i=0;i<quotes.length;i++){
					elem +='<div class="col-md-3 col-sm-6 col-xs-12"><blockquote><p>'+quotes[i]['quote']+'</p><footer>'+quotes[i]['author'];
					if(quotes[i]['position']){
						elem += ', <cite title="Source Title">'+quotes[i]['position']+'</cite>';
					}
					elem += '</footer></blockquote></div>';
				}
				// Append
				$(".fashion_quotes").append(elem);
			}
		}
	})
}
// Fade an element by id
function fade(id) {
	if(document.getElementById(id).style.opacity=="0.2") {
		document.getElementById(id).style.opacity="1";
	} else if(document.getElementById(id).style.opacity=="1") {
		document.getElementById(id).style.opacity="0.2";
	}
}
// Create checkbox (for image as checkbox)
function createCheckbox(id,name,value,IDParent,checked,style) {
	var input = document.createElement("input");
	input.type = "checkbox";
	input.id = id;
	input.name = name;
	input.value = value;
	input.checked = checked;
	input.style = style;
	document.getElementById(IDParent).appendChild(input);
	//$("input[type='checkbox']").iCheck({checkboxClass: 'icheckbox_flat-green'}); //wrap with iCheck
	//$(".icheckbox_flat-green").attr({"style": style});
}
// Title Case
function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt) {
    	return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}
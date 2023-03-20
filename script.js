if (document.querySelector("section"))
	document.querySelector("section").addEventListener("click", function (e) {
		if (e.target.dataset.productid) {
			document.querySelector(".fa-shopping-basket").classList.add("itemcartclass");
			let cartcount = document.querySelector("p.counter");
			cartcount.innerHTML = parseInt(cartcount.innerHTML) + 1;
			fetch("./addcart.php?productid=" + e.target.dataset.productid + "&userid=" + document.body.querySelector("header").dataset.uid + "&amount=1")
				.then((response) => response)
				.then((data) => console.log(data));
		}
		setTimeout(() => {
			document.querySelector(".fa-shopping-basket").classList.remove("itemcartclass");
		}, 1000);
	})

function showsort() {
	document.querySelector(".sort").classList.toggle("show");
}

function showsort2() {
	document.querySelector(".sort2").classList.toggle("show");
}

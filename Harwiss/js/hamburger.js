

function toggleSidebar(){
	document.getElementById("sidebar").classList.toggle("active");
}


const styles = `
	<style>
		#product {
			width: 300px;
			height: 300px;
		}

		#product .title {
			font-size: 20px;
			font-weight: bold;
		}
	</style>
`

const page1 = ` ${styles}
	<div id="product">
		<div class="title">Product 1</div>
		<div data-in-stock="10"></div>
		<button onclick="alert('Product 1 is added to the cart')">Add to cart</button>
	</div>
`

const page2 = ` ${styles}
	<div id="product">
		<div class="title">Product 2</div>
		<div data-in-stock="10"></div>
	</div>
`

const page3 = ` ${styles}
	<div id="product">
		<div class="title">Product 3</div>
		<div data-in-stock="0"></div>
		<button onclick="alert('Product 3 is added to the cart')">Add to cart</button>
	</div>
`

const page4 = ` ${styles}
	<div id="product">
		<div class="title">Product 4</div>
		<button onclick="alert('Product 4 is added to the cart')">Add to cart</button>
	</div>
`

//document.body.innerHTML = page3

/**
 * Write answer here
*/

setTimeout(_ => {
	// Your code here
}, 1000)


/**
 *
*/
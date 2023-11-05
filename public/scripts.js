const template = {

data(){
    return {
        subcategories: null,
        display_catalog: false,
        display_cart: false,
        selected_color: null,
        cat_id: 0,
        products_count: 1,
        cart_row: 0,
        cart_products: new Array()
    }
},
mounted() {
    this.update_cart_rows()
    this.parse_cookie_cart()
},
methods: {
    updateSubctgs(id){
        axios.get("http://localhost:8000/api/getSubcategories/"+id)
        .then(response => (
            this.subcategories = response.data
        ));
    },
    selectColor(i){

        let colors_count = document.querySelectorAll('.selectColor').length;
        for (let a = 1; a <= colors_count; a++) {
            if (i !== a){document.getElementById('selectColor'+a).style.border="black 5px solid"}        
        }
        document.getElementById('selectColor'+i).style.border="rgb(20, 170, 20) 5px solid";
        let color = rgb2hex(document.getElementById('selectColor'+i).style.backgroundColor);
        this.selected_color = color;
        
    },
    subtract_products_count(){
        if (this.products_count > 1) {this.products_count--}
    },
    add_products_count(){
        this.products_count++
    },
    add_to_cart(product){
        this.cart_row++
        setCookie('product'+this.cart_row, {'title': product.product_title, 'id': product.product_id, 'count': this.products_count, 'color': this.selected_color});
        this.cart_products.push(JSON.parse(getCookie('product'+this.cart_row)))
        this.products_count = 1
        setCookie('products_count', this.cart_row, {expires: Date.now() + 7 * 24 * 60 * 60 * 1000});
    },
    update_cart_rows(){

        if (getCookie('products_count')) {
            this.cart_row = parseInt(getCookie('products_count'))
        }

    },
    parse_cookie_cart(){

        for (var i = 1; i <= getCookie('products_count'); i++){
            this.cart_products.push(JSON.parse(getCookie('product'+i)))
        }

    },
    clear_cart(){
        setCookie('products_count', 0, {expires: Date.now() + 7 * 24 * 60 * 60 * 1000});
        for (var i = 1; i <= getCookie('products_count'); i++){
            deleteCookie('product'+i)
        }
        this.cart_products = new Array()
        this.cart_row = 0
    }
}

}

const app = Vue.createApp(template)

app.mount('#app')

function rgb2hex(rgb) {
    var rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);

    return (rgb && rgb.length === 4) ? "#" +
        ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}

function DeleteAllCookie() {
	var cookies = document.cookie.split(";");
	for (var i = 0; i < cookies.length; i++) {
		var cookie = cookies[i];
		var eqPos = cookie.indexOf("=");
		var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
		document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;";
		document.cookie = name + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	}
}
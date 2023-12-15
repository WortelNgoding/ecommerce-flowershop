document.addEventListener('alpine:init', () => {
    
    Alpine.data('products', () => ({
        items: window.productsData || []
    }))

    Alpine.store('cart', {
        items: [],
        total: 0,
        quantity: 0,
        add(newItem) {
            // cek apakah ada barang yang sama di cart 
            const cartItem = this.items.find((item) => item.id === newItem.id);

            // jika belum ada / cart masih kosong
            if (!cartItem) {
                this.items.push({...newItem, quantity: 1, total: newItem.price});
                this.quantity++;
                this.total += parseInt(newItem.price);  
            } else {
                // jika barang sudah ada, cek apakah barang beda atau sama dengan yang ada di cart
                this.items = this.items.map((item) => {
                    if (item.id !== newItem.id) {
                        return item;
                    } else {
                        // jika barang sudah ada, tambah quantity dan totalnya
                        item.quantity++
                        item.total = item.price * item.quantity;
                        this.quantity++;
                        this.total += parseInt(newItem.price);
                        return item;
                    }
                })
            }
        },
        remove(id) {
            // ambil item yang mau diremove berdasarkan id
            const cartItem = this.items.find((item) => item.id === id);
            
            // jika item lebih dari 1
            if(cartItem.quantity > 1) {
                this.items = this.items.map((item) => {
                    // jika bukan barang yang diklik
                    if(item.id !== id) {
                        return item;
                    } else {
                        item.quantity--;
                        item.total = parseInt(item.price) * item.quantity;
                        this.quantity--;
                        this.total -= parseInt(item.price);
                        return item;
                    }
                })
            } else if (cartItem.quantity === 1) {
                // jika barang sisa satu
                this.items = this.items.filter((item) => item.id !== id);
                this.quantity--;
                this.total -= cartItem.price;
            }
        }
    })
})

// form validation 
const checkoutButton = document.querySelector('.checkout-button');
checkoutButton.disabled = true;

const form = document.querySelector('#checkoutForm');
form.addEventListener('keyup', function() {
    for (let i = 0; i < form.elements.length ; i++) {
        if (form.elements[i].value.length !== 0 ) {
            checkoutButton.classList.remove('disabled');
            checkoutButton.classList.add('disabled');
        } else {
            return false;
        }
    }

    checkoutButton.disabled = false;
    checkoutButton.classList.remove('disabled');
})

// kirim data ketika tombol checkout diklik
checkoutButton.addEventListener('click', async function(e) {
    e.preventDefault();
    const formData = new FormData(form);
    const data = new URLSearchParams(formData);
    const objData = Object.fromEntries(data);

    //! const message = formatMessage(objData);
    //! window.open('http://wa.me/6285732680197?text=' + encodeURIComponent(message));

    try {
        const response = await fetch('./midtrans-server/placeOrder.php', {
            method: 'POST',
            body: data,
        });
        const token = await response.text();
        // console.log(token);
        window.snap.pay(token);
    } catch (err) {
        console.log(err.message);
    }


});

//! format pesan whatsapp
// const formatMessage = (obj) => {
//     return `Data Customer
//         Nama : ${obj.name}
//         Email : ${obj.email}
//         No HP : ${obj.phone}
//     Data Pesanan 
//         ${JSON.parse(obj.items).map((item) => `${item.nama} (${item.quantity} x ${rupiah(item.total)}) \n `)}
//     Total : ${rupiah(obj.total)}
//     Terima kasih!`

// }

// konversi ke rupiah

const rupiah = (number) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(number);
}
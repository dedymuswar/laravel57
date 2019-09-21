Vue.component('tampil', {
    template: `
        <label for="name" class="col-sm-2 col-form-label">Kembalian:</label>
    `
})

var app = new Vue({
    el: "#kembalian",
    data: {
        bayar: "",
        hasil: "",
        show: false
    },
    watch: {
        bayar: function (val) {

            var total = this.$refs.dey.innerText;
            this.bayar = val;
            totals = val - parseFloat(total.replace(/,/g, ''));
            this.hasil = formatNumber(totals);
        }
    },
    methods: {
        readRefs: function () {
            console.log(this.$refs.dey.innerText);
        }
    },
});

function formatNumber(num) {
    // return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    return 'Rp.' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

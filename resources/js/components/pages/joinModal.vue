<template>
    <div class="h-100 text-gold">
        <b-container class="pt-3 pb-2 text-gold">
            <h5 class="text-white">{{ msg }}</h5>
            <h6 class="text-gold mt-5">Choose Amount</h6>
            <div class="mt-3">
                <Button class="mt-2" shape="circle" ghost @click="amunt('30')"
                    >30</Button
                >
                <Button class="mt-2" shape="circle" ghost @click="amunt('50')"
                    >50</Button
                >
                <Button
                    shape="circle"
                    ghost
                    @click="amunt('100')"
                    class="active1 mt-2"
                    >100</Button
                >
                <Button class="mt-2" shape="circle" ghost @click="amunt('300')"
                    >300</Button
                >
                <Button class="mt-2" shape="circle" ghost @click="amunt('500')"
                    >500</Button
                >
                <Button class="mt-2" shape="circle" ghost @click="amunt('1000')"
                    >1000</Button
                >
                <Button shape="circle" ghost @click="amunt('3000')"
                    >3000</Button
                >
                <Button class="mt-2" shape="circle" ghost @click="amunt('5000')"
                    >5000</Button
                >
                <Button
                    class="mt-2"
                    shape="circle"
                    ghost
                    @click="amunt('10000')"
                    >10000</Button
                >
                <Button
                    class="mt-2"
                    shape="circle"
                    ghost
                    @click="amunt('30000')"
                    >30000</Button
                >
                <Button
                    class="mt-2"
                    shape="circle"
                    ghost
                    @click="amunt('50000')"
                    >50000</Button
                >
                <Button
                    class="mt-1"
                    shape="circle"
                    ghost
                    @click="amunt('100000')"
                    >100000</Button
                >
            </div>
            <h6 class="text-gold mt-3">Enter Amount(Bet Amount)>=1</h6>
            <div class="mt-3">
                <b-container>
                    <input
                        type="text"
                        class="form-control cstmform"
                        v-model="data.amount"
                    />
                </b-container>
            </div>
            <div class="mt-3 text-white">
                Total Amount <span class="text-gold">{{ data.amount }}</span>
            </div>
            <div class="mt-4">
                <Button
                    shape="circle"
                    type="success"
                    long
                    size="large"
                    @click="submit"
                >
                    Confirm</Button
                >
            </div>
        </b-container>
    </div>
</template>

<script>
export default {
    props: ["msg", "bal", "colnums", "gameId"],
    data() {
        return {
            colnum: "",
            minutes: 0,
            seconds: 0,
            distance: 0,
            user_id: "",
            balance: "",
            data: {
                amount: localStorage.amt
            }
        };
    },

    methods: {
        amunt(amt) {
            localStorage.setItem("amt", amt);
            this.data.amount = localStorage.amt;
        },
        submit() {
            localStorage.setItem("amt", this.data.amount);
            if (this.balance > this.data.amount) {
                //    store the the user bet and time
                axios
                    .post("/api/game", {
                        user_id: this.user_id,
                        amount: this.data.amount,
                        time: this.minutes + this.seconds,
                        colnum: this.$props.colnums,
                        game_id: this.$props.gameId,
                        minute: this.minutes,
                        second: this.seconds
                    })
                    .then(res => {
                        console.log(res);
                        this.$FModal.hide();
                    })
                    .catch(err => {
                        this.$FModal.hide();
                        console.log(err);
                        if (err.response.data.error) {
                            this.i(res.response.data.error);
                        } else if (err.response.message) {
                            this.i(err.response.message);
                        }
                    });
                //cut the balance from user wallet
                axios
                    .post("/api/bet/" + this.user_id, {
                        user_id: this.user_id,
                        balance: this.data.amount,
                        minute: this.minutes,
                        second: this.seconds,
                        colnum: this.$props.colnums,
                        game_id: this.$props.gameId
                    })
                    .then(res => {
                        this.i("Bet Submitted Successfully");
                        console.log(res);
                        this.$attrs.update(res.data[0]);
                        this.$FModal.hide();
                    })
                    .catch(err => {
                        if (err.response.data.error) {
                            this.e(err.response.data.error);
                        }
                    });
            } else {
                this.i("not enough balance to bet");
            }
        }
    },
    created() {
        if (!localStorage.amt) {
            this.data.amount = 100;
        }
        if (this.minutes <= 0) {
            this.$props.game_id = parseInt(this.$props.game_id) + 1;
        }
        axios
            .get("/api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                if (res.data[0] == "token_expired") {
                    this.auth = "";
                    this.$router.push("/login");
                }
                this.balance = res.data.balance;
                this.user_id = res.data.user.id;
            })
            .catch(err => {
                console.log(err);
            });
    },
    mounted() {
        var vm = this;
        setInterval(function() {
            var now = new Date().getTime();
            vm.distance = localStorage.time - now;
            var m = Math.floor(vm.distance % (1000 * 60 * 60)) / (1000 * 60);
            vm.minutes = parseFloat(m).toFixed(0);
            vm.seconds = Math.floor((vm.distance % (1000 * 60)) / 1000);
            if (vm.seconds < 10) {
                vm.seconds = "0" + vm.seconds;
            }
            if (vm.seconds > 29) {
                vm.minutes -= 1;
                vm.minutes = vm.minutes.toString();
            }
            if (vm.minutes == 0 && vm.seconds == 18) {
                vm.spinShow = true;
            }
            if (vm.minutes <= 0 && vm.seconds <= 0) {
                vm.spinShow = false;
            }

            if (vm.distance < 0) {
                if (vm.distance < -1000 * 60 * 24 * 1) {
                    vm.countDownDate += 1000 * 60 * 60 * 24 * 1 * 365;
                }
            }
        }, 1000);
    }
};
</script>

<style scoped>
/* .h-100 {
    min-height: 500px;
} */
.text-gold {
    background-color: #011f47ed !important;
    color: goldenrod;
}
.active1 {
    color: goldenrod !important;
    border-color: goldenrod !important;
    background: transparent !important;
}
.cstmform {
    background-color: #011f47ed;
    border-color: white;
    color: goldenrod;
}
.cstmform::placeholder {
    color: goldenrod;
}
.cstmform:focus {
    background: transparent;
    color: goldenrod;
}
</style>

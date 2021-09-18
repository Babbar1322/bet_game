<template>
    <div>
        <perfect-scrollbar>
            <b-container>
                <b-row>
                    <b-col md="2"></b-col>
                    <b-col md="8" class="pr-0 pl-0">
                        <b-card class="bg-royalblue pl-2 pr-2 pt-5 mh">
                            <div class="text-center">
                                <b-img
                                    v-bind="mainProps"
                                    src="whatsapp.png"
                                ></b-img>
                                <h3 class="text-white d-inline pt-2">
                                    WhatsApp
                                </h3>
                                <h6 class="mt-5 text-white">open whatsapp</h6>
                                <div class="mt-4">
                                    <Button
                                        shape="circle"
                                        type="success"
                                        size="Large"
                                        :to="phone"
                                    >
                                        CHAT</Button
                                    >
                                </div>
                            </div>
                        </b-card>
                    </b-col>
                </b-row>
            </b-container>
        </perfect-scrollbar>
    </div>
</template>

<script>
export default {
    data() {
        return {
            mainProps: { width: 50 },
            phone: null
        };
    },
    created() {
        axios
            .get("/api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                this.phone = "https://wa.me/91" + res.data.user.phone;
            })
            .catch(err => {
                console.log(err);
            });
    }
};
</script>

<style>
.bg-royalblue {
    background-color: #353849 !important;
}
/* .card {
    min-height: 472px;
} */
.mh {
    min-height: 530px !important;
}
@media (max-width: 600px) {
    .mh {
        min-height: 610px !important;
    }
}
</style>

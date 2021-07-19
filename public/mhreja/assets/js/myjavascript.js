$(".notice-popup").click(function () {
    var route = $(this).data("route");
    $.ajax({
        url: route,
        success: function (result) {
            result = JSON.parse(result);
            $("#noticeContent").html(result);
        },
    });
});

$("[data-autoscroll]").autoscroll({
    interval: 10000,
    hideScrollbar: true,
    handlerIn: null,
    handlerOut: null,
});

var url =
    "https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?11613";
var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
s.src = url;
var options = {
    enabled: true,
    chatButtonSetting: {
        backgroundColor: "#4dc247",
        ctaText: "",
        borderRadius: "25",
        marginLeft: "0",
        marginBottom: "50",
        marginRight: "50",
        position: "right",
    },
    brandSetting: {
        brandName: "NeetJeeBank",
        brandSubTitle: "Disscuss, Learn, Grow",
        brandImg: "https://neetjeebank.com/mhreja/assets/images/favicon.png",
        welcomeText: "Hi there!\nHow can I help you?",
        messageText: "Hello, I have a question.",
        backgroundColor: "#1164b4",
        ctaText: "Start Chat",
        borderRadius: "25",
        autoShow: false,
        phoneNumber: "919593352884",
    },
};
s.onload = function () {
    CreateWhatsappChatWidget(options);
};
var x = document.getElementsByTagName("script")[0];
x.parentNode.insertBefore(s, x);

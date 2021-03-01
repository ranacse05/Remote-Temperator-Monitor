$(function(){
    $("#gauge").dxCircularGauge({
        scale: {
            startValue: 10,
            endValue: 50,
    		tickInterval: 5,
            label: {
                customizeText: function (arg) {
                    return arg.valueText + " &#8451;";
                }
            }
        },
        rangeContainer: {
            ranges: [
                { startValue: 10, endValue: 17, color: "#228B22" },
                { startValue: 17, endValue: 33, color: "#FFD700" },
                { startValue: 33, endValue: 50, color: "#CE2029" }
            ]
        },
        "export": {
            enabled: false
        },
        title: {
            text: "Post-Paid Server Room",
            font: { size: 28 }
        },
        value: 27
    });



    $("#gauge2").dxCircularGauge({
        scale: {
            startValue: 10,
            endValue: 50,
            tickInterval: 5,
            label: {
                customizeText: function (arg) {
                    return arg.valueText + " &#8451;";
                }
            }
        },
        rangeContainer: {
            ranges: [
                { startValue: 10, endValue: 17, color: "#228B22" },
                { startValue: 17, endValue: 33, color: "#FFD700" },
                { startValue: 33, endValue: 50, color: "#CE2029" }
            ]
        },
        "export": {
            enabled: false
        },
        title: {
            text: "Pre-Paid Server Room",
            font: { size: 28 }
        },
        value: 27
    });
});
// Use this script on pages that mobile users shouldn't access
// Credit: https://developer.mozilla.org/en-US/docs/Web/HTTP/Browser_detection_using_the_user_agent

// Detects if the device is using a touchscreen
// Falls back to basic user agent detection if it can't find one
var hasTouchScreen = false;
if ("maxTouchPoints" in navigator) {
    hasTouchScreen = navigator.maxTouchPoints > 0;
} else if ("msMaxTouchPoints" in navigator) {
    hasTouchScreen = navigator.msMaxTouchPoints > 0;
} else {
    var mQ = window.matchMedia && matchMedia("(pointer:coarse)");
    if (mQ && mQ.media === "(pointer:coarse)") {
        hasTouchScreen = !!mQ.matches;
    } else if ('orientation' in window) {
        hasTouchScreen = true; // deprecated, but good fallback
    } else {
        // Only as a last resort, fall back to user agent sniffing
        var UA = navigator.userAgent;
        hasTouchScreen = (
            /\b(BlackBerry|webOS|iPhone|IEMobile)\b/i.test(UA) ||
            /\b(Android|Windows Phone|iPad|iPod)\b/i.test(UA)
        );
    }
}

// Redirects to the sleephome page if the device is a mobile device

if (hasTouchScreen == true) {
    window.location.replace("SleepHome.php");
}
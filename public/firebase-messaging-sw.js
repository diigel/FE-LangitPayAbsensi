// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.24.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
var firebaseConfig = {
    apiKey: "AIzaSyDPwhEkUJs2jpe4ZT4dAQUxK1SuULeZ2Wc",
    authDomain: "langitpayabsensi-1bc50.firebaseapp.com",
    databaseURL: "https://langitpayabsensi-1bc50.firebaseio.com",
    projectId: "langitpayabsensi-1bc50",
    storageBucket: "langitpayabsensi-1bc50.appspot.com",
    messagingSenderId: "1037070547229",
    appId: "1:1037070547229:web:d8c4b45501b78accccc9f4",
    measurementId: "G-3QEEZZ0BEW"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

// message background handler
messaging.setBackgroundMessageHandler(function (payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
        body: 'Background Message body.',
        icon: '/firebase-logo.png'
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
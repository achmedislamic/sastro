module.exports = {
    presets: [require("./vendor/ph7jack/wireui/tailwind.config.js")],
    purge: {
        enabled: false,
        content: [
            "./resources/**/*.blade.php",
            "./resources/**/*.js",
            "./resources/**/*.vue",
            "./vendor/ph7jack/wireui/resources/**/*.blade.php",
            "./vendor/ph7jack/wireui/ts/**/*.ts",
            "./vendor/ph7jack/wireui/src/View/**/*.php",
        ],
    },
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
    },
    variants: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};

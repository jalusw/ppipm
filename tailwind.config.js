/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "5rem",
                "2xl": "6rem",
            },
        },
        fontFamily: {
            sans: ["Inter", "sans-serif"],
        },
        extend: {},
    },
    plugins: [require("@tailwindcss/typography"), require("daisyui")],
    daisyui: {
        themes: [
            {
                taposi: {
                    primary: "#23CE6B",
                    secondary: "#272D2D",
                    accent: "#00cea3",
                    neutral: "#F6F8FF",
                    "base-100": "#fff",
                    info: "#2D82B7",
                    success: "#62bd00",
                    warning: "#ffc500",
                    error: "#FF4242",
                },
            },
        ],
        darkTheme: false,
    },
};

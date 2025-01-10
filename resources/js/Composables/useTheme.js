import { onMounted, ref } from 'vue';

export function useTheme() {
    const isDark = ref(false);

    const toggleTheme = () => {
        isDark.value = !isDark.value;
        updateTheme();
    };

    const updateTheme = () => {
        // Update localStorage
        localStorage.setItem('theme', isDark.value ? 'dark' : 'light');

        // Update DOM
        if (isDark.value) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    };

    onMounted(() => {
        // Check localStorage or system preference
        isDark.value =
            localStorage.theme === 'dark' ||
            (!('theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches);

        updateTheme();
    });

    return {
        isDark,
        toggleTheme,
    };
}

import { onMounted, ref } from 'vue';

export default function useScrollToBottom(containerRef) {
    const scrollToBottom = () => {
        const container = containerRef.value;
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    };

    onMounted(() => {
        scrollToBottom(); // Automatically scroll to the bottom when the component is mounted
    });

    return {
        scrollToBottom,
    };
}

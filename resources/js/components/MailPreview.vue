<template>
    <div class="container">
        <div v-html="htmlOutput.html"></div>
    </div>
</template>

<script>
    import mjml2html from 'mjml-browser'

    export default {
        props: ["preview"],
        data() {

            return {
                mjmlRaw: this.preview,
            }
        },
        computed: {
            htmlOutput() {
                return mjml2html(this.mjmlRaw);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

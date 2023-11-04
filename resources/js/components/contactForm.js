export default (phone, templates = {}) => ({
    name: '',
    topic: '',
    message: '',

    send() {
        const whatsapp = 'https://api.whatsapp.com/send';
        const params = {
            opening: `${templates.opening || ''} ${this.name}, %0A%0A`,
            topic: `${templates.topic || ''} ${this.topic} %0A%0A`,
            message: `${templates.message || ''} ${this.message} %0A%0A`,
            closing: `${templates.closing || ''}`,
        };
        const url = `${whatsapp}?phone=${phone}&text=${params.opening}${params.topic}${params.message}${params.closing}`;

        window.open(url, '_blank').focus();
    },
});

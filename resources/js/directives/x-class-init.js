export default (el, {modifiers, expression}, {evaluate}) => {
    const delayIndex = modifiers.findIndex(mod => mod === 'delay');
    const delayMs = delayIndex > -1 ? parseInt(modifiers[delayIndex + 1], 10) : 300;

    const holdIndex = modifiers.findIndex(mod => mod === 'hold');
    const holdMs = holdIndex > -1 ? parseInt(modifiers[holdIndex + 1], 10) : 300;

    const classes = evaluate(expression);

    const addClasses = () => {
        el.classList.add(...classes);
    }

    const removeClasses = () => {
        el.classList.remove(...classes);
    }

    setTimeout(addClasses, delayMs);
    setTimeout(removeClasses, holdMs);
}

const faq = document.querySelector('.faqBox');

faq.addEventListener('click', (e) => {
    const element = e.target.closest('.faqItem');
    if (element) {
        e.target.closest('.faqItem').classList.toggle('faqHidden');
    }
});

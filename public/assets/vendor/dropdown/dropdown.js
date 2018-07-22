			jQuery(document).ready(function($) {

				var faqsSections = $('.cd-faq-group'),
					faqTrigger = $('.cd-faq-trigger'),
					faqsContainer = $('.cd-faq-items'),
					faqsCategoriesContainer = $('.cd-faq-categories'),
					faqsCategories = faqsCategoriesContainer.find('a'),
					closeFaqsContainer = $('.cd-close-panel');

				faqTrigger.on('click', function(event) {
					event.preventDefault();
					$(this).next('.cd-faq-content').slideToggle(200).end().parent('li').toggleClass('content-visible');
				});
			});
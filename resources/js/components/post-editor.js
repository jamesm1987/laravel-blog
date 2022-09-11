import { times } from "lodash"

class postEditor {
    
    constructor(element) {
        this.element = element
        this.postTags = this.element.querySelector('[name="tags"]')
        this.postCategories = this.element.querySelector('[name="categories"]')
        this.postCategoriesSelector = this.element.querySelector('[data-categories-selector]')
        this.postTagsSelector = this.element.querySelector('[data-tags-selector]')
        this.setActionButton = document.querySelector('[data-set-action]')
        
        this.bindEvents()
    }

    bindEvents() {
        this.postCategoriesSelector.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', this.toggleCategories.bind(this))
        })

        this.postTagsSelector.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', this.toggleTags.bind(this))
        })

        this.setActionButton.addEventListener('click', this.setAction.bind(this))
        
        
    }

    setAction(event) {
        let 
            clicked = event.target,
            action = clicked.getAttribute('data-action'),
            target = this.element.querySelector(['[name="action"]'])

            target.value = action
    }

    toggleCategories() {
        let selectedCategories = []
        this.postCategoriesSelector.querySelectorAll('input:checked').forEach(checked => {
            selectedCategories.push(checked.value)
        })
        
        this.postCategories.value = selectedCategories
    }

    toggleTags() {
        let selectedTags = []
        this.postTagsSelector.querySelectorAll('input:checked').forEach(checked => {
            selectedTags.push(checked.value)
        })
        
        this.postTags.value = selectedTags
    }   


}

const editor = document.querySelector('[data-post-editor]')

if (editor) {
    new postEditor(editor)
}

export default postEditor
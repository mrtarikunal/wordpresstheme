//wp wordpress in global değişkeni
//bunun içinde blocks yer alır
//registerBlockType ile yeni bir block type tanmlyrz
//ilk argument slug gibi düşüneblrz block typnın, ismi = tarik/border-box

wp.blocks.registerBlockType('tarik/border-box', {
    title: 'My Cool Border Box',
    icon: 'smiley',
    category: 'common',
    attributes: {
        content: {type: 'string'},
        color: {type: 'string'}
    },
    //user ın gireceği attribute ları tanmlyrz
    edit: function(props) {
        function updateContent(event) {
            props.setAttributes({content: event.target.value})
        }

        function updateColor(value) {
            props.setAttributes({color: value.hex})
        }

        return wp.element.createElement(
            "div",
            null,
            wp.element.createElement(
                "h3",
                null,
                "Your Cool Border Box"
            ),
            wp.element.createElement("input", { type: "text", value: props.attributes.content, onChange: updateContent }),
            wp.element.createElement(wp.components.ColorPicker, { color: props.attributes.color, onChangeComplete: updateColor })
        );
    },
    //edit admin panelde kullanıcının gördüğü bölüm
    save: function(props) {
        return wp.element.createElement(
            "h3",
            { style: { border: "5px solid " + props.attributes.color } },
            props.attributes.content
        );
    }
})

//save frontend de gösterilen html çıktı
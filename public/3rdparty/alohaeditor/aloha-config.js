var Aloha = window.Aloha || ( window.Aloha = {} );
Aloha.settings = {
    plugins: {
        format: {
            config: [ 'b', 'i', 'u', 'del', 'sub', 'sup', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'pre'],
            editables: {
                heading1: [ 'b', 'i', 'u', 'del', 'sub', 'sup'  ],
                heading2: [ 'b', 'i', 'u', 'del', 'sub', 'sup'  ],
                heading3: [ 'b', 'i', 'u', 'del', 'sub', 'sup'  ]
            }
        }
    },
    sidebar: {
        disabled: false
    },
    exclude: [ 'strong', 'emphasis', 'strikethrough' ]
};

<template>
    <div>
      <vue-editor v-model="targetContent" :editor-toolbar="customToolbar"/>
    </div>
  </template>
  
  <script>
  import { VueEditor } from "vue2-editor";
  
  export default {
    components: { VueEditor },
    props: {
        content: String,
    },
    data: () => ({
        
        customToolbar: [
        // [{ font: [] }],
        [{ header: [
            false, 
            // 1, 
            // 2, 
            3, 
            4, 
            5, 
            6] 
        }],
        // [{ size: ["small", false, "large", "huge"] }],
        ["bold", "italic", "underline", "strike"],
        [
        { align: "" },
        { align: "center" },
        { align: "right" },
        { align: "justify" }
        ],
        // [{ header: 1 }, { header: 2 }],
        ["blockquote", "code-block"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        // [{ script: "sub" }, { script: "super" }],
        [{ indent: "-1" }, { indent: "+1" }],
        [{ color: [] }, { background: [] }],
        [
            "link", 
            "image", 
            // "video", 
            // "formula"
        ],
        // [{ direction: "rtl" }],
        // ["clean"]
        ]
    }),
    mounted() {
        this.targetContent = this.content
    },
    computed: {
        targetContent: {
            set(content) {
               return content;
            }
        }
    },
  };
  </script>
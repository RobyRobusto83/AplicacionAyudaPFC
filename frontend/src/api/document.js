/**
 * Mocking client-server processing
 */
const _document = {
  title: 'Proyecto Fin de Ciclo',
  sections: [
      {
        id: '0a3164f5-d88d-4b83-bea9-541d6af6e933', 
        title: 'Introducción',
        subsections: [
          {
            id: 'b4d140e7-f9ec-4cd2-aad6-76e7334844bd', 
            title: 'Estado del arte', 
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mollis rhoncus cursus. Nam aliquet felis et imperdiet porta. Nunc arcu erat, volutpat dapibus erat id, pulvinar mollis felis.<br />Etiam lobortis, erat at fringilla venenatis, urna turpis dictum mi, nec commodo elit libero quis ante.<br />Nulla feugiat aliquam diam, eget viverra massa fringilla ac. In ultricies arcu id mi aliquam, in malesuada neque luctus. Aliquam erat volutpat. Aenean egestas orci dignissim eros malesuada lacinia. In feugiat massa et tincidunt luctus. Maecenas ac vehicula justo.",
          },
          {
            id: '069040b1-6412-48d5-be39-7028cbfab306', 
            title: 'Motivación', 
            content: "Maecenas non luctus leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.<br />Nullam elit sem, ornare a quam vitae, aliquam volutpat nunc. Sed lectus turpis, maximus at euismod a, pellentesque vel libero. Duis sit amet ipsum tristique, viverra massa vel, convallis arcu.<br />Sed in orci in lectus fermentum laoreet. Sed bibendum lacinia dignissim. Phasellus orci ante, accumsan vitae semper id, ornare vitae dolor. Proin viverra elit tellus, ac rutrum odio luctus a.<br />Suspendisse leo nibh, fermentum eget rhoncus eu, finibus vitae urna.",
          }
        ]
      },
      {
        id: 'cd3df352-6ef4-4611-8216-a3a45e6d70bf', 
        title: 'Desarrollo',
        subsections: [
          {
            id: 'de054834-7123-40da-9037-f26cf3e758ae', 
            title: 'Arquitectura', 
            content: "Morbi dignissim magna quis bibendum euismod. Nam lectus purus, dictum nec congue vel, ultricies at massa. Proin lectus ante, congue ut nulla vel, ullamcorper molestie nibh. ",
          },
          {
            id: '3a346eb0-7d24-4046-ab7f-5c65c01e63ec', 
            title: 'Elementos', 
            content: "Aliquam scelerisque suscipit eros, vitae rhoncus nibh iaculis non. Aliquam egestas arcu purus, elementum consequat nisl egestas id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus venenatis volutpat quam. Nunc ac ante id nisi porta dignissim. Sed pellentesque feugiat facilisis. Aenean hendrerit dolor a odio consequat vehicula.",

          }
        ]
      },
      {
        id: '2c2052e9-30d2-4c8e-b87f-3459a251c0f6',
        title: 'Bibliografía',
        subsections: [
          {
            id: 'de054834-7123-40da-9037-f26cf3e758hg', 
            title: 'Referencias', 
            content: "<ul><li>Morbi dignissim magna quis bibendum euismod.</li><li>Nam lectus purus, dictum nec congue vel, ultricies at massa.</li><li>Proin lectus ante, congue ut nulla vel, ullamcorper molestie nibh.</li></ul> ",
          },
        ]
      }
    ] 
  }

export default {
    getDocument (cb) {
        setTimeout(() => cb(_document), 100)
    }
}
import Vue from 'vue'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

// const vueFiles = ;
// /[\w-]+\.vue$/
// https://webpack.js.org/guides/dependency-management/#require-context
const requireComponent = require.context(
    // Look for files in the current directory
    '../components/',
    // Do not look in subdirectories
    true,
    // Only include "_base-" prefixed .vue files
    /[A-Z]\w+\.(vue|js)$/
);
// For each matching file name...
requireComponent.keys().forEach((fileName) => {
    // Get the component config
    const componentConfig = requireComponent(fileName)
    // Get the PascalCase version of the component name
    // Obtém nome em PascalCase do componente
    const componentName = upperFirst(
        camelCase(
            // Obtém o nome do arquivo, independentemente da profundidade da pasta
            fileName
                .split('/')
                .pop()
                .replace(/\.\w+$/, '')
        )
    );

    // Globally register the component
    Vue.component(componentName, componentConfig.default || componentConfig)
});

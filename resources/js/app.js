import { createApp } from 'vue';

const componentModules = import.meta.glob('./components/**/*.vue', { eager: true });

function resolveComponent(name) {
	const matches = [
		`./components/${name}.vue`,
		`./components/${name}/index.vue`,
	];

	for (const path of matches) {
		if (componentModules[path]?.default) {
			return componentModules[path].default;
		}
	}

	return null;
}

function parseProps(rawProps, componentName) {
	if (!rawProps) {
		return {};
	}

	try {
		return JSON.parse(rawProps);
	} catch (error) {
		console.warn(`Failed to parse props for ${componentName}.`, error);
		return {};
	}
}

document.querySelectorAll('[data-vue-component]').forEach((element) => {
	const componentName = element.dataset.vueComponent;
	const component = resolveComponent(componentName);

	if (!component) {
		console.warn(`Vue component not found: ${componentName}`);
		return;
	}

	const props = parseProps(element.dataset.props, componentName);

	createApp(component, props).mount(element);
});

# WP GraphQL Extended

Adds a WP GraphQL field that replicate `get_extended()` function behavior. It allows you to obtain the content before/after the more tag.

## Requirements

-   [WP GraphQL](https://github.com/wp-graphql/wp-graphql)

## Description

By default, the `get_extended()` function from WordPress is not implemented in WP GraphQL. I'm used to use it, so I decided to create this feature.

If you don't know `get_extended`, you can read more information in [WordPress documentation](https://developer.wordpress.org/reference/functions/get_extended/). It allows you to split your content into two parts: the one before the more tag and the one after.

This plugin allows you to retrieve this two parts for each posts including Custom Post Types. You can also choose the output format: `raw` or `rendered`.

**Query example:**

```graphql
query SinglePost($slug: String!) {
	posts {
		edges {
			node {
				contentParts {
					beforeMore(format: RAW)
					afterMore
				}
			}
		}
	}
}
```

**Note:** If your post does not contain a more tag, the `beforeMore` part contains your post and the `afterMore` part is empty.

## Installation

Download this repo, then put the plugin inside your `wp-content/plugins/` directory and activate it in your WordPress admin.

## License

This WordPress plugin is open-source and available under the [GPL-v2-or-later license](./LICENSE).

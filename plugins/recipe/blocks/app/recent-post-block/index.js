import block_icons from "../icons/index";


const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { Component } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, RadioControl, ToggleControl, QueryControls } =   wp.components;

let options = []; // Is it okay to define options variable here?

class myEditPosts extends Component {
  // Method for setting the initial state.
  static getInitialState( selectedPost ) {
    return {
      posts: [],
      selectedPost: selectedPost,
      post: {},
    };
  }
  // Construct the component. Set everythin to "this" using super().
  // Now we can access the attributes with this.props.attributes
  constructor() {
    super(...arguments);
    this.state = this.constructor.getInitialState(
      this.props.attributes.selectedPost
    );
    // Bind so we can use 'this' inside the method.
    this.getOptions = this.getOptions.bind(this);
    // Load recipes/posts.
    this.getOptions();
  }

  /**
   * Loading Posts
   */
  getOptions() {
    // Extend and wp.api.collections.Posts to load a custom post type
    const CustomPosts = wp.api.collections.Posts.extend({
      url: wpApiSettings.root + "wp/v2/recipe",
    //   model: BLProduct,
    });

        const someCustomPosts = new CustomPosts();
        someCustomPosts.fetch({ data: { per_page: 3 } }).then( ( posts ) => {
            if (posts && 0 !== this.state.selectedPost) {
                // This is the same as { post: post, posts: posts }
                this.setState({ post, posts });
                } else {
                    this.setState({ posts });
                }
        } );
        return someCustomPosts;
}

  render() {
    let output = __( 'Loading Posts' );
    this.props.className += " loading";
    // console.log(this.state.posts);
    console.log('render called');
    if (this.state.posts.length > 0 && options.length <= 0) {
      console.log('options array contains posts')
      console.log(options)
      const loading = __( 'We have %d posts. Choose one.' );
      output = loading.replace( "%d", this.state.posts.length );
      this.state.posts.forEach(( post ) => { // post CONTEXT
        options.push({ 
            new_val: post.id,
            label: post.title.rendered,
            content: post.content.rendered,
            link: post.link
        });
        // output += post.title.rendered;
      });
    } else {
      // output = __( 'No posts found. Please create some first.' );
      console.log('options array is EMPTY');
      console.log(options)
    }
    // Checking if we have anything in the object
    // if (this.state.post.hasOwnProperty("title")) {
    //   output = (
    //     <div className="post">
    //       <a href={this.state.post.link}>
    //         <h5
    //           dangerouslySetInnerHTML={{
    //             __html: this.state.post.title.rendered,
    //           }}
    //         ></h5>
    //       </a>
    //       <p
    //         dangerouslySetInnerHTML={{
    //           __html: this.state.post.content.rendered,
    //         }}
    //       ></p>
    //     </div>
    //   );
    //   this.props.className += " has-post";
    // } else {
    //   this.props.className += " no-post";
    // }

    return [

        // 1. Option: Display content    2. Select dropdown: Order By     3. Scroll: Number of posts   
        <InspectorControls>
                <PanelBody title={ __( 'Latest Recipes Controls', 'recipe' ) }>
                    <ToggleControl
                        label={ __( 'Toggle Content', 'recipe' ) }
                        help={ __( 'Hide/Show Content', 'recipe' ) }
                        checked={ this.props.attributes.displayPostContent }
                        onChange={ ( new_val ) => {
                            this.props.setAttributes( { displayPostContent: new_val } )
                            console.log(new_val)
                        } }
                    />
                    {/* { this.props.attributes.displayPostContent && (
                              <RadioControl
                                label={ __( 'Show:' ) }
                                selected={ this.props.attributes.displayPostContentRadio }
                                options={ [
                                  { label: __( 'Excerpt' ), new_val: 'excerpt' },
                                  { label: __( 'Full post' ), new_val: 'full_post', },
                                ] }
                                onChange={ ( new_val ) =>
                                  this.props.setAttributes( {
                                    displayPostContentRadio: new_val,
                                  } )
                                }
                              />
                        ) } 
                      */}

                </PanelBody>
                <PanelBody title={__( 'Sorting and filtering' )}>
                    <QueryControls
                        // {...{ order, orderBy }}
                        numberOfItems={ this.props.attributes.postsToShow }
                        onOrderChange={( new_val ) => this.props.setAttributes({ order: new_val })}
                        onOrderByChange={( new_val ) =>
                          this.props.setAttributes({ orderBy: new_val })
                        }
                    />

                </PanelBody>
          </InspectorControls>,
            <div>
                {options.map((option) => (
                <div>
                    <a href={option[ 'link' ]}>
                    <h5 dangerouslySetInnerHTML={{ __html: option["label"] }}></h5>
                    </a>
                    {this.props.attributes.displayPostContent &&
                                this.props.attributes.displayPostContent === true && (
                                    <p dangerouslySetInnerHTML={{ __html: option["content"] }}></p>
                    )}
                    
                </div>
                ))}
            </div>
    ];
  }
}

// class mySavePosts extends Component {
            
// }

registerBlockType("prince/recent-recipes", {
  title: __("Latest Recipes", "recipe"),
  description: __(
    "Display the most recent recipes from the collection",
    "recipe"
  ),
  category: "common",
  icon: block_icons.wapuu,
  attributes: {
    content: {
      type: "array",
      source: "children",
      selector: "p",
    },
    title: {
      type: "string",
      selector: "h5",
    },
    link: {
      type: "string",
      selector: "a",
    },
    selectedPost: {
      type: "number",
      default: 0,
    },
    toggleContent: {
        type: "boolean",
        default: "false"
    },
    displayPostContent: {
        type: "boolean"
    },
    displayPostContentRadio: {
        type: "boolean",
        default: "excerpt"
    },
    order: {
        type: "string",
    },
    orderBy: {
        type: "string",
    },
    postsToShow: {
        type: "string",
    }
  },

  edit: myEditPosts,

  save: ( props ) => {
    return (       
      // <div>
      //     {options.map((option) => (
      //     <div>
      //         <a href={option[ 'link' ]}>
      //         <h5 dangerouslySetInnerHTML={{ __html: option["label"] }}></h5>
      //         </a>
      //         {props.attributes.displayPostContent &&
      //                     props.attributes.displayPostContent === true && (
      //                         <p dangerouslySetInnerHTML={{ __html: option["content"] }}></p>
      //         )}
              
      //     </div>
      //     ))}
      // </div>
        <p>VALID?</p>
      );
  }
});
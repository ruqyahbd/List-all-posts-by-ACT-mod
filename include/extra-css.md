Newly added css codes, put these on head of frontend, where you will use ACT shortcode.

```
table {
    background-color: #fdf6e3;
    border-color: #93a1a1;
    border-style: solid;
    border-width: 1px;
    color: #002b36;
    font-size: 16px;
    overflow: hidden;
}

table tbody tr {
    background-color: #fefcf9;
}

.search-filter-wrapper {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.search-filter-wrapper input,
.search-filter-wrapper select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

#tableSearch {
    flex: 1 1 auto;
}

#categoryFilter,
#writerFilter {
    flex: 0 1 200px;
}

@media (max-width: 600px) {
    .category-column,
    .writer-column {
        display: none;
    }

    #categoryFilter,
    #writerFilter {
        flex: 1 1 100%;
    }
}
```
